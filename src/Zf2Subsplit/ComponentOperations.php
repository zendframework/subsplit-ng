<?php

namespace Zf2Subsplit;

class ComponentOperations
{
    protected static $components = array(
        'Component_ZendAuthentication' => array(
            'name' => 'Component_ZendAuthentication',
            'path' => 'library/Zend/Authentication/',
        ),
        'Component_ZendBarcode' => array(
            'name' => 'Component_ZendBarcode',
            'path' => 'library/Zend/Barcode/',
        ),
        'Component_ZendCache' => array(
            'name' => 'Component_ZendCache',
            'path' => 'library/Zend/Cache/',
        ),
        'Component_ZendCaptcha' => array(
            'name' => 'Component_ZendCaptcha',
            'path' => 'library/Zend/Captcha/',
        ),
        'Component_ZendCode' => array(
            'name' => 'Component_ZendCode',
            'path' => 'library/Zend/Code/',
        ),
        'Component_ZendConfig' => array(
            'name' => 'Component_ZendConfig',
            'path' => 'library/Zend/Config/',
        ),
        'Component_ZendConsole' => array(
            'name' => 'Component_ZendConsole',
            'path' => 'library/Zend/Console/',
        ),
        'Component_ZendCrypt' => array(
            'name' => 'Component_ZendCrypt',
            'path' => 'library/Zend/Crypt/',
        ),
        'Component_ZendDb' => array(
            'name' => 'Component_ZendDb',
            'path' => 'library/Zend/Db/',
        ),
        'Component_ZendDebug' => array(
            'name' => 'Component_ZendDebug',
            'path' => 'library/Zend/Debug/',
        ),
        'Component_ZendDi' => array(
            'name' => 'Component_ZendDi',
            'path' => 'library/Zend/Di/',
        ),
        'Component_ZendDom' => array(
            'name' => 'Component_ZendDom',
            'path' => 'library/Zend/Dom/',
        ),
        'Component_ZendEscaper' => array(
            'name' => 'Component_ZendEscaper',
            'path' => 'library/Zend/Escaper/',
        ),
        'Component_ZendEventManager' => array(
            'name' => 'Component_ZendEventManager',
            'path' => 'library/Zend/EventManager/',
        ),
        'Component_ZendFeed' => array(
            'name' => 'Component_ZendFeed',
            'path' => 'library/Zend/Feed/',
        ),
        'Component_ZendFile' => array(
            'name' => 'Component_ZendFile',
            'path' => 'library/Zend/File/',
        ),
        'Component_ZendFilter' => array(
            'name' => 'Component_ZendFilter',
            'path' => 'library/Zend/Filter/',
        ),
        'Component_ZendForm' => array(
            'name' => 'Component_ZendForm',
            'path' => 'library/Zend/Form/',
        ),
        'Component_ZendHttp' => array(
            'name' => 'Component_ZendHttp',
            'path' => 'library/Zend/Http/',
        ),
        'Component_ZendI18n' => array(
            'name' => 'Component_ZendI18n',
            'path' => 'library/Zend/I18n/',
        ),
        'Component_ZendInputFilter' => array(
            'name' => 'Component_ZendInputFilter',
            'path' => 'library/Zend/InputFilter/',
        ),
        'Component_ZendJson' => array(
            'name' => 'Component_ZendJson',
            'path' => 'library/Zend/Json/',
        ),
        'Component_ZendLdap' => array(
            'name' => 'Component_ZendLdap',
            'path' => 'library/Zend/Ldap/',
        ),
        'Component_ZendLoader' => array(
            'name' => 'Component_ZendLoader',
            'path' => 'library/Zend/Loader/',
        ),
        'Component_ZendLog' => array(
            'name' => 'Component_ZendLog',
            'path' => 'library/Zend/Log/',
        ),
        'Component_ZendMail' => array(
            'name' => 'Component_ZendMail',
            'path' => 'library/Zend/Mail/',
        ),
        'Component_ZendMath' => array(
            'name' => 'Component_ZendMath',
            'path' => 'library/Zend/Math/',
        ),
        'Component_ZendMemory' => array(
            'name' => 'Component_ZendMemory',
            'path' => 'library/Zend/Memory/',
        ),
        'Component_ZendMime' => array(
            'name' => 'Component_ZendMime',
            'path' => 'library/Zend/Mime/',
        ),
        'Component_ZendModuleManager' => array(
            'name' => 'Component_ZendModuleManager',
            'path' => 'library/Zend/ModuleManager/',
        ),
        'Component_ZendMvc' => array(
            'name' => 'Component_ZendMvc',
            'path' => 'library/Zend/Mvc/',
        ),
        'Component_ZendNavigation' => array(
            'name' => 'Component_ZendNavigation',
            'path' => 'library/Zend/Navigation/',
        ),
        'Component_ZendPaginator' => array(
            'name' => 'Component_ZendPaginator',
            'path' => 'library/Zend/Paginator/',
        ),
        'Component_ZendPermissionsAcl' => array(
            'name' => 'Component_ZendPermissionsAcl',
            'path' => 'library/Zend/Permissions/Acl/',
        ),
        'Component_ZendPermissionsRbac' => array(
            'name' => 'Component_ZendPermissionsRbac',
            'path' => 'library/Zend/Permissions/Rbac/',
        ),
        'Component_ZendProgressBar' => array(
            'name' => 'Component_ZendProgressBar',
            'path' => 'library/Zend/ProgressBar/',
        ),
        'Component_ZendSerializer' => array(
            'name' => 'Component_ZendSerializer',
            'path' => 'library/Zend/Serializer/',
        ),
        'Component_ZendServer' => array(
            'name' => 'Component_ZendServer',
            'path' => 'library/Zend/Server/',
        ),
        'Component_ZendServiceManager' => array(
            'name' => 'Component_ZendServiceManager',
            'path' => 'library/Zend/ServiceManager/',
        ),
        'Component_ZendSession' => array(
            'name' => 'Component_ZendSession',
            'path' => 'library/Zend/Session/',
        ),
        'Component_ZendSoap' => array(
            'name' => 'Component_ZendSoap',
            'path' => 'library/Zend/Soap/',
        ),
        'Component_ZendStdlib' => array(
            'name' => 'Component_ZendStdlib',
            'path' => 'library/Zend/Stdlib/',
        ),
        'Component_ZendTag' => array(
            'name' => 'Component_ZendTag',
            'path' => 'library/Zend/Tag/',
        ),
        'Component_ZendTest' => array(
            'name' => 'Component_ZendTest',
            'path' => 'library/Zend/Test/',
        ),
        'Component_ZendText' => array(
            'name' => 'Component_ZendText',
            'path' => 'library/Zend/Text/',
        ),
        'Component_ZendUri' => array(
            'name' => 'Component_ZendUri',
            'path' => 'library/Zend/Uri/',
        ),
        'Component_ZendValidator' => array(
            'name' => 'Component_ZendValidator',
            'path' => 'library/Zend/Validator/',
        ),
        'Component_ZendVersion' => array(
            'name' => 'Component_ZendVersion',
            'path' => 'library/Zend/Version/',
        ),
        'Component_ZendView' => array(
            'name' => 'Component_ZendView',
            'path' => 'library/Zend/View/',
        ),
        'Component_ZendXmlRpc' => array(
            'name' => 'Component_ZendXmlRpc',
            'path' => 'library/Zend/XmlRpc/',
        ),
    );

    protected static $componentList;
    protected $componentPathMap;

    protected $git;
    protected $maxTagHistory = '2.months';
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
     * Checkout a repository branch and update to latest revision
     * 
     * @param string $branch 
     * @param null|string $componentPath 
     */
    public function updateBranch($branch, $componentPath = null)
    {
        $this->checkoutBranch($branch, $componentPath);
//        $this->git->execute('fetch origin');
//        $this->git->execute('rebase origin/%s', array($branch));
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
        $this->updateBranch($branch, $componentPath);

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
     * Get revision and timestamp for a given ZF2 tag
     * 
     * @param  string $version 
     * @return array
     */
    public function getZf2TagInfo($version)
    {
        $tagName = 'release-' . $version;
        chdir($this->zf2Path);
        $revList = $this->git->execute('rev-list %s', array($tagName), true);
        if (strstr($revList, 'fatal: ambiguous argument')) {
            throw new \DomainException(sprintf(
                'Tag version %s not found in ZF2 repository',
                $version
            ));
        }
        $revisions = explode("\n", $revList);
        $revision  = array_shift($revisions);

        $timestamp = $this->git->execute('show --format=format:"%%ct" %s', array($revision), true);
        $timestamp = (int) trim($timestamp);
        return compact('revision', 'timestamp');
    }

    /**
     * Tag a component based on ZF2 tag revision
     * 
     * @param string $component 
     * @param string $version 
     * @param array $zf2RevInfo 
     * @return bool
     */
    public function tagComponent($component, $version, array $zf2RevInfo)
    {
        $componentPath = $this->repoPath . '/' . $component;
        $this->updateBranch('master', $componentPath);

        // Traverse revisions of component in reverse order
        $revisions = $this->getComponentRevisions();
        do {
            $revision = array_shift($revisions);

            // get date of commit on component's master
            $revInfo = $this->git->execute('show --format=format:"%%ct:%%s" %s', array($revision), true);
            list($timestamp, $subject) = explode(':', $revInfo, 2);

            // Compare sha1 of commit to ZF2 sha1 for tag
            if ($revision === $zf2RevInfo['revision']) {
                $this->tagRevision($version, $zf2RevInfo['revision'], $revision);
                return true;
            }

            // Compare date of commit to date of tag
            if ($timestamp <= $zf2RevInfo['timestamp']) {
                $this->tagRevision($version, $zf2RevInfo['revision'], $revision);
                return true;
            }

            // Compare ZF2 sha1 of commit to ZF2 sha1 for tag
            if (preg_match('#zendframework/zf2@(?P<revision>[a-f0-9]{40}) \((?P<timestamp>\d+)\)#i', $subject, $matches)) {
                // Revision was based on ZF2 tag revision
                if ($matches['revision'] === $zf2RevInfo['revision']) {
                    $this->tagRevision($version, $zf2RevInfo['revision'], $revision);
                    return true;
                }

                // Revision is older then ZF2 tag revision
                if ($matches['timestamp'] <= $zf2RevInfo['timestamp']) {
                    $this->tagRevision($version, $zf2RevInfo['revision'], $revision);
                    return true;
                }
            }
        } while ($revisions);

echo "No suitable commits found in allowed history ({$this->maxTagHistory})\n";
        return false;
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
        $components = array();
        foreach ($files as $filename) {
            if (!preg_match('#^library/Zend/([^/]+)/#', $filename)) {
                continue;
            }

            $component = $this->lookupComponentFromPath($filename);
            if (!$component
                || array_key_exists($component, $components)
            ) {
                continue;
            }

            $components[$component] = static::$components[$component];
        }
        return $components;
    }

    /**
     * compareRevisions 
     *
     * Returns false if the component revision is newer than the ZF2 revision.
     * Returns true if the component revision is older (meaning it needs to be updated).
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
        if (is_array($zf2RevisionInfo)) {
            $zf2Revision  = $zf2RevisionInfo['revision'];
            $zf2Timestamp = $zf2RevisionInfo['timestamp'];
        } else {
            list($zf2Revision, $zf2Timestamp) = explode(':', $zf2RevisionInfo, 2);
        }

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

    protected function lookupComponentFromPath($filePath)
    {
        foreach ($this->getComponentPathMap() as $path => $component) {
            if (strstr($filePath, $path)) {
                return $component;
            }
        }
        return false;
    }

    /**
     * Get a map of filesystem paths => component names
     * 
     * @return array
     */
    protected function getComponentPathMap()
    {
        if (is_array($this->componentPathMap)) {
            return $this->componentPathMap;
        }
        $components = array();
        foreach (static::$components as $component) {
            $components[$component['path']] = $component['name'];
        }
        $this->componentPathMap = $components;
        return $components;
    }

    /**
     * Get the list of components
     * 
     * @return array
     */
    public static function getComponentList()
    {
        if (is_array(static::$componentList)) {
            return static::$componentList;
        }
        static::$componentList = array_keys(static::$components);
        return static::$componentList;
    }

    /**
     * Tag a repository for a given ZF2 version, specifying the ZF2 revision
     * 
     * @param string $version 
     * @param string $zf2Revision 
     * @param string $revision 
     */
    protected function tagRevision($version, $zf2Revision, $revision)
    {
        $this->git->execute('tag -a -m \'Zend Framework %s (%s)\' release-%s %s', array($version, $zf2Revision, $version, $revision));
    }

    /**
     * Get revisions on master branch in reverse chronological order
     * 
     * @return array
     */
    protected function getComponentRevisions()
    {
        $data = $this->git->execute('rev-list --max-age="%s" master', array($this->maxTagHistory), true);
        $revisions = explode("\n", $data);
        array_walk($revisions, function (&$value) {
            $value = trim($value);
        });
        return $revisions;
    }
}
