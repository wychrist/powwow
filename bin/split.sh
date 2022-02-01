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
remote congregate_contract git@github.com:wychrist/congregate_contract.git
remote congregate_cms git@github.com:wychrist/congregate_cms.git
remote congregate_headless git@github.com:wychrist/congregate_headless.git
remote congregate_theme git@github.com:wychrist/congregate_theme.git
remote congregate_user git@github.com:wychrist/congregate_user.git
remote congregate_setting git@github.com:wychrist/congregate_setting.git


# call split
split 'projects/congregate/Modules/CongregateContract' congregate_contract
split 'projects/placeholder/Modules/CongregateCms' congregate_cms
split 'projects/congregate/Modules/CongregateHeadless' congregate_headless
split 'projects/placeholder/Modules/CongregateTheme' congregate_theme
split 'projects/congregate/Modules/CongregateUser' congregate_user
split 'projects/placeholder/Modules/CongregateSetting' congregate_setting
