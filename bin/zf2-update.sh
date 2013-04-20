#!/bin/sh
if [ $# -ne 3 ];then
    echo "Expects exactly 3 arguments; cannot update ZF2" ;
    echo "Usage $0 [zf2 path] [branch] [git executable]" ;
    exit 1 ;
fi
ZF2_PATH=$1
ZF2_BRANCH=$2
GIT=$3

(cd $ZF2_PATH && $GIT fetch origin)
(cd $ZF2_PATH && $GIT checkout $ZF2_BRANCH 2>&1 && $GIT rebase origin/$ZF2_BRANCH) > /dev/null
rev_info=$(cd $ZF2_PATH && $GIT log -1 --format=format:"%H:%ct")
echo $rev_info
exit 0
