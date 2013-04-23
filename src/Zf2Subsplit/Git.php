<?php

namespace Zf2Subsplit;

class Git
{
    protected $dryRun = false;
    protected $git;

    public function __construct($git = null)
    {
        if (null !== $git) {
            if (!is_executable($git)) {
                $git = ResolveExecutable::lookup($git);
            }
        }
        $this->git = $git;
    }

    public function setDryRun($flag)
    {
        $this->dryRun = (bool) $flag;
        return $this;
    }

    public function isDryRun()
    {
        return $this->dryRun;
    }

    public function execute($command, array $args = array(), $return = false)
    {
        $command = '%s ' . $command;
        array_unshift($args, $this->git);

        $command = vsprintf($command, $args);
        if ($this->isDryRun()) {
            file_put_contents('php://stdout', $command);
            if ($return) {
                return $return;
            }
            return;
        }

        if ($return) {
            return shell_exec($command);
        }

        system($command);
    }

    public function stat($branch)
    {
        $command = 'log --format=format:"%%H" origin/%s..%s';
        $stat    = $this->execute($command, array($branch, $branch), true);
        $stat    = trim($stat);
        if (empty($stat)) {
            return false;
        }
        return true;
    }
}
