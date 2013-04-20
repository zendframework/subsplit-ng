<?php
/**
 * Tag all component repos for specific ZF2 tag
 */
use Zf2Subsplit\ComponentOperations;
use Zf2Subsplit\Git;

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Chicago');
require __DIR__ . '/../vendor/autoload.php';

$git = new Git();

chdir(__DIR__ . '/../repos');
if (!dir_exists('zf2')) {
    echo "Cloning ZF2... ";
    $git->execute('clone git://github.com/zendframework/zf2.git');
    chdir(__DIR__ . '/../repos/zf2');
    $git->execute('checkout -b develop origin/develop');
    $git->execute('checkout master');
    echo "[DONE]\n";
}

foreach (ComponentOperations::getComponentList() as $component) {
    echo "Cloning $component... ";
    chdir(__DIR__ . '/../repos');
    if (dir_exists($component)) {
        echo "Directory already exists; skipping\n";
        continue;
    }
    $git->execute('clone git@github.com:zendframework/%s', array($component));
    chdir(__DIR__ . '/../repos/' . $component);
    $git->execute('checkout -b develop origin/develop');
    $git->execute('checkout master');
    echo "[DONE]\n";
}
