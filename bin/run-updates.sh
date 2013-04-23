#!/bin/sh
# Script runner for updating master/develop branches of repositories.
# If you use a git or PHP executable that's not on the path of the script
# runner, you can pass them in as environment variables:
#
#     export PHP=/usr/local/zend/bin/php ; export GIT=/usr/local/bin/git ; run-updates.sh
# 
# The script writes to STDOUT, and includes timestamped entries:
#
# - Before updating the master branch
# - Before updating the develop branch
# - When done

SCRIPT_PATH=$(readlink -f $0)
WORKDIR=$(dirname $SCRIPT_PATH)
WORKDIR=$(dirname $WORKDIR)

RUNNING=$WORKDIR/data/running
if [ -f "$RUNNING" ];then
    TS=$(date -R) ;
    echo "[$TS] Another update is currently running" ;
    exit 0 ;
fi

touch $RUNNING

if [ -z "$GIT" ];then
    GIT="git"
fi
if [ -z "$PHP" ];then
    PHP="php"
fi

echo "[$(date -R)] Updating master branches"
(cd $WORKDIR && make update-master GIT=$GIT PHP=$PHP)
(cd $WORKDIR && make push BRANCH=master GIT=$GIT)

echo "[$(date -R)] Updating develop branches"
(cd $WORKDIR && make update-develop GIT=$GIT PHP=$PHP)
(cd $WORKDIR && make push BRANCH=develop GIT=$GIT)

echo "[$(date -R)] DONE"

rm $RUNNING
