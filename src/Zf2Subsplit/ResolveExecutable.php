<?php

namespace Zf2Subsplit;

abstract class ResolveExecutable
{
    protected static $paths;

    public static function lookup($executable)
    {
        foreach (static::getPath() as $path) {
            $file = $path . DIRECTORY_SEPARATOR . $executable;
            if (is_executable($file)) {
                return $file;
            }
        }
        throw new \InvalidArgumentException(sprintf(
            'Could not resolve %s on the current PATH',
            $executable
        ));
    }

    protected static function getPath()
    {
        if (is_array(static::$paths)) {
            return static::$paths;
        }

        static::$paths = explode(PATH_SEPARATOR, $_SERVER['PATH']);
        return static::$paths;
    }
}
