<?php
/**
 * Update component repos for ZF2.
 *
 * Algorithm:
 *
 * Given prev/next info for a branch:
 * - For each revision since previous update
 *   (git log --format=format:"%H:%ct" --since=($ts + 1) --reverse)
 *   - Get list of files changed in revision
 *     (git show --name-only --format=format:"%b" $revision)
 *   - loop through files, retrieving filename object
 *     - toss anything not in "library"
 *   - build component list from files
 *   - foreach component with changes:
 *     - rsync files between zf2 library and component library
 *       (use option to ensure deletions)
 *     - descend into component library ; git add . && git commit -a -m 'Sync 
 *       with zendframework/zf2@$REVISION'
 */

use Zf2Subsplit\ComponentOperations;
use Zf2Subsplit\Git;
use Zf2Subsplit\Rsync;

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Chicago');
require __DIR__ . '/../vendor/autoload.php';

// Marshal arguments
if ($argc != 7) {
    $message  = sprintf("[%s] Invalid arguments (requires 6, received %d)\n", $argv[0], $argc - 1);
    $message .= sprintf("Usage:\n    %s [zf2_path] [branch] [SHA1:TS] [repo_path] [git executable] [rsync executable]\n", $argv[0]);
    file_put_contents('php://stderr', $message);
    exit(1);
}
$zf2Path         = $argv[1];
$branch          = $argv[2];
list($sha1, $ts) = explode(':', trim($argv[3]), 2);
$ts              = (int) $ts;
$repoPath        = $argv[4];
$git             = $argv[5];
$rsync           = $argv[6];

$git   = new Git($git);
$rsync = new Rsync($rsync);

$operations = new ComponentOperations($git, $rsync, $zf2Path, $repoPath);

// Get revisions since last update on this branch
$operations->checkoutBranch($branch, $zf2Path);

$revisions = $operations->getRevisionsSinceTimestamp($ts + 1);
if (!$revisions) {
    echo "No revisions found!\n";
    exit(0);
}

foreach ($revisions as $revision) {
    $operations->updateComponentsToRevision($revision, $branch);
}

// Checkout original branch we were working on
$operations->checkoutBranch($branch, $zf2Path);
