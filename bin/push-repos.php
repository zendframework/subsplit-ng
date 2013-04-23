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
    $message .= sprintf("Usage:\n    %s [branch|tags] [git executable] [zf2_dir] [repos_dir]\n", $argv[0]);
    file_put_contents('php://stderr', $message);
    exit(1);
}
$branch    = $argv[1];

if (!in_array($branch, array('master', 'develop', 'tags'))) {
    $message = sprintf("[%s] Expects first argument to be one of 'master', 'develop' or 'tags'\nReceived '%s'", $argv[0], $branch);
    file_put_contents('php://stderr', $message);
    exit(1);
}

$git       = $argv[2];
$zf2Path   = $argv[3];
$reposPath = $argv[4];

$git        = new Git($git);
$rsync      = new Rsync();
$operations = new ComponentOperations($git, $rsync, $zf2Path, $reposPath);

foreach (ComponentOperations::getComponentList() as $component) {
    echo "Pushing $component...\n";
    $componentPath = sprintf('%s/%s', $reposPath, $component);
    switch ($branch) {
        case 'tags':
            echo "    Pushing tags\n";
            chdir($componentPath);
            $git->execute('push --tags origin');
            break;
        case 'master':
        case 'develop':
        default:
            $operations->checkoutBranch($branch, $componentPath);
            if ($git->stat($branch)) {
                printf("    Pushing %s branch\n", $branch);
                $git->execute('push origin %s:%s', array($branch, $branch));
            }
            break;
    }
    echo "[DONE]\n";
}
