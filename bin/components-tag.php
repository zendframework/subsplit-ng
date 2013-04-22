<?php
/**
 * Tag all component repos for specific ZF2 tag
 */
use Zf2Subsplit\ComponentOperations;
use Zf2Subsplit\Git;
use Zf2Subsplit\Rsync;

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Chicago');
require __DIR__ . '/../vendor/autoload.php';

// Marshal arguments
if ($argc != 5) {
    $message  = sprintf("[%s] Invalid arguments (requires 4, received %d)\n", $argv[0], $argc - 1);
    $message .= sprintf("Usage:\n    %s [version] [zf2_path] [repo_path] [git executable]\n", $argv[0]);
    file_put_contents('php://stderr', $message);
    exit(1);
}
$version         = $argv[1];
$zf2Path         = $argv[2];
$repoPath        = $argv[3];
$git             = $argv[4];

$git   = new Git($git);
$rsync = new Rsync();

$operations = new ComponentOperations($git, $rsync, $zf2Path, $repoPath);

// Make sure we have all tags fetched locally
chdir($zf2Path);
$git->execute('fetch origin');

// Get ZF2 tag information for given version
$tagInfo = $operations->getZf2TagInfo($version);

echo "Tagging components for version $version\n";
echo "    Revision:  " . $tagInfo['revision'] . "\n";
echo "    Timestamp: " . $tagInfo['timestamp'] . "\n";

// Loop through comonents and tag
foreach (ComponentOperations::getComponentList() as $component) {
    echo "Tagging component $component...\n";
    if (!$operations->tagComponent($component, $version, $tagInfo)) {
        echo "    [ FAILED ] tagging $component\n";
        continue;
    }
    echo "    [ DONE ] tagging $component\n";
}
