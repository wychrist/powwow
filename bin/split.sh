#!/usr/bin/env bash

# copied from: https://github.com/laravel/framework/blob/8.x/bin/split.sh

set -e
set -x

CURRENT_BRANCH="main"

function split()
{
    SHA1=`./bin/splitsh-lite --prefix=$1`
    git push $2 "$SHA1:refs/heads/$CURRENT_BRANCH" -f
}

function remote()
{
    git remote add $1 $2 || true
}

git pull origin $CURRENT_BRANCH

# register remote
remote congregate_user git@github.com:wychrist/congregate_user.git


# call split
split 'projects/congregate/Modules/CongregateUser' congregate_user
