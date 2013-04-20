<?php

namespace Zf2Subsplit;

class Rsync
{
    protected $rsync = 'rsync';

    protected $dryRun = false;

    public function __construct($rsync = null)
    {
        if (null !== $rsync) {
            if (!is_executable($rsync)) {
                $rsync = ResolveExecutable::lookup($rsync);
            }
            $this->rsync = $rsync;
        }
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

    public function execute($source, $destination)
    {
        // Do not bring over swap or undo files, but DO ensure .git 
        // files/directores are not removed!
        $command = '%s --quiet --archive --filter="P .git*" --exclude=".*.sw*" --exclude=".*.un~" --delete %s %s';
        $command = sprintf($command, $this->rsync, $source, $destination);
        if ($this->isDryRun()) {
            file_put_contents('php://stdout', $command);
            return;
        }

        system($command);
    }
}
