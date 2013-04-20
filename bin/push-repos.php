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

// Marshal arguments
if ($argc != 3) {
    $message  = sprintf("[%s] Invalid arguments (requires 2, received %d)\n", $argv[0], $argc);
    $message .= sprintf("Usage:\n    %s [git executable] [repos_dir]\n", $argv[0]);
    file_put_contents('php://stderr', $message);
    exit(1);
}
$git       = $argv[1];
$reposPath = $argv[2];

$git = new Git($git);

foreach (ComponentOperations::getComponentList() as $component) {
    echo "Pushing $component...\n";
    chdir(sprintf('%s/%s', $reposPath, $component));
    echo "    Pushing master branch\n";
    $git->execute('push origin master:master');
    echo "    Pushing develop branch\n";
    $git->execute('push origin develop:develop');
    echo "    Pushing tags\n";
    $git->execute('push --tags origin');
    echo "[DONE]\n";
}
