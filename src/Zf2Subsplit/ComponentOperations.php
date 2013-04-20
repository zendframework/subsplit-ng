<?php

namespace Zf2Subsplit;

class ComponentOperations
{
    protected $git;
    protected $repoPath;
    protected $rsync;
    protected $zf2Path;

    public function __construct(Git $git, Rsync $rsync, $zf2Path, $repoPath)
    {
        $this->git      = $git;
        $this->rsync    = $rsync;
        $this->zf2Path  = $zf2Path;
        $this->repoPath = $repoPath;
    }

    /**
     * Checkout a specific branch in a repository
     *
     * If no repository is specified, assumes ZF2 repository.
     *
     * Switches directories to the given repository and performs the checkout.
     * 
     * @param string $branch 
     * @param string $repo 
     */
    public function checkoutBranch($branch, $repo = null)
    {
        if (null === $repo) {
            $repo = $this->zf2Path;
        }
        chdir($repo);
        $this->git->execute('checkout %', array($branch));
    }

    /**
     * Get list of revisions since a given timestamp, in chronological order
     * 
     * @param  int $timestamp 
     * @return false|array False if none found; array otherwise
     */
    public function getRevisionsSinceTimestamp($timestamp)
    {
        $revisions = $this->git->execute('log --format=format:"%%H:%%ct" --since="%s" --reverse', array($timestamp), true);
        if (empty($revisions)) {
            return false;
        }
        $revisions = explode("\n", $revisions);
        if (empty($revisions)) {
            return false;
        }

        array_walk($revisions, function (&$value) {
            $value = trim($value);
        });
        return array_filter($revisions, function ($revision) {
            $result = preg_match('/[a-f0-9]{5,40}:\d+/', $revision);
            if (false === $result || 0 === $result) {
                return false;
            }
            return true;
        });
    }

    /**
     * Update components to ZF2 revision on given branch
     * 
     * @param string $revision 
     * @param string $branch 
     */
    public function updateComponentsToRevision($revision, $branch)
    {
echo "Updating components to ZF2 revision $revision\n";
        chdir($this->zf2Path);
        list($revSha1, $revTS) = explode(':', $revision, 2);

        // Get components changed in revision
        $components = $this->getComponentsFromRevision($revSha1);
        if (empty($components)) {
echo "    No Components affected:\n";
            return;
        }

echo "    Components affected:\n        " . array_reduce($components, function ($string, $component) {
    $string .= $component['name'] . "\n        ";
    return $string;
}, '') . "\n";

        // Checkout specified revision of ZF2
        $this->git->execute('checkout --quiet %s', array($revSha1));

        foreach ($components as $component) {
            $this->updateComponentRepo($component, $branch, $revSha1, $revTS);
        }
    }

    /**
     * Retrieve list of components affected by revision
     * 
     * @param  string $revision 
     * @return array
     */
    public function getComponentsFromRevision($revision)
    {
        $files = $this->git->execute('show --name-only --format=format:"%%b" %s', array($revision), true);
        $files = explode("\n", $files);
        return $this->getComponentsFromFileList($files);
    }

    /**
     * Update an individual component repo
     *
     * Updates the given component's branch to the specified revision and/or
     * timestamp.
     *
     * @param array $component
     * @param string $branch
     * @param string $revision
     * @param int $timestamp
     * @param Rsync $rsync
     */
    public function updateComponentRepo(
        array $component,
        $branch,
        $revision,
        $timestamp
    ) {
echo "    Updating component {$component['name']}\n";
        // Create the path to the component repository
        $componentPath = sprintf('%s/%s', $this->repoPath, $component['name']);

        // Ensure branch is up-to-date
        $this->checkoutBranch($branch, $componentPath);
//        $this->git->execute('fetch origin');
//        $this->git->execute('rebase origin/%s', array($branch));

        // Get latest revision on component branch, and determine if we need to update the component.
        $componentRevInfo = $this->git->execute('log -1 --format=format:"%%H:%%ct:%%s"', array(), true);
        if (!$this->compareRevisions($revision . ':' . $timestamp, $componentRevInfo)) {
echo "        Nothing to do\n";
            return;
        }

        // Enter the component directory of the ZF2 repository
        chdir(sprintf('%s/%s', $this->zf2Path, $component['path']));

        // rsync files to the component repository
        $this->rsync->execute('.', $componentPath);

        chdir($componentPath);
        $this->git->execute('add .');
        $this->git->execute("commit -a -m 'zendframework/zf2@%s (%d)'", array($revision, $timestamp));
echo "        DONE\n";
    }

    /**
     * Retrieve a list of affected components from a git revision
     *
     * Loops through the files of a git diff; if any given file is a file inside 
     * the library, it determines the component affected, and adds it to the list 
     * it returns.
     * 
     * @param  array $diff 
     * @return array
     */
    protected function getComponentsFromFileList(array $files)
    {
        $components = [];
        foreach ($files as $filename) {
            if (!preg_match('#^library/Zend/(?P<component>[^/]+)/(?P<subcomponent>[^/.]+)#', $filename, $matches)) {
                continue;
            }

            $component    = $matches['component'];
            $subcomponent = $matches['subcomponent'];

            if ($component == 'Permissions') {
                $component = sprintf('%s/%s', $component, $subcomponent);
            }

            $componentName = sprintf('Component_Zend%s', str_replace('/', '', $component));
            if (array_key_exists($componentName, $components)) {
                continue;
            }

            $componentPath = sprintf('library/Zend/%s', $component);
            $components[$componentName] = array(
                'name' => $componentName,
                'path' => $componentPath,
            );
        }
        return $components;
    }

    /**
     * compareRevisions 
     *
     * Returns false if the component revision is newer than the ZF2 revision.
     * Returns true if the compnent revision is older (meaning it needs to be updated).
     * 
     * @param  string $zf2RevisionInfo 
     * @param  string $componentRevisionInfo 
     * @return bool
     */
    protected function compareRevisions($zf2RevisionInfo, $componentRevisionInfo)
    {
        $componentRevisionInfo = trim($componentRevisionInfo);
        if (empty($componentRevisionInfo)) {
echo "        No component revision information discovered!!!!\n";
            return false;
        }
        list($zf2Revision, $zf2Timestamp) = explode(':', $zf2RevisionInfo, 2);
        list($revision, $ts, $subject) = explode(':', $componentRevisionInfo, 3);
        if (!preg_match('#^zendframework/zf2@(?P<rev>[a-f0-9]{5,40}) \((?P<ts>\d+)\)#', $subject, $matches)) {
            // If subject does not match regex, check revision string.
            if ($revision == $zf2Revision) {
                // If they match, nothing to do.
                return false;
            }

            // If revision timestamp is equal or greater than ZF2 timestamp, nothing to do.
            return ($ts < $zf2Timestamp);
        }

        if ($matches['rev'] == $zf2Revision) {
            // Revisions match; nothing to do.
            return false;
        }

        // If component timestamp is equal or greater than ZF2 timestamp, nothing to do.
        return ((int) $matches['ts'] < $zf2Timestamp);
    }
}
