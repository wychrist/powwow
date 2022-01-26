# abort on errors
set -e

# build
yarn run docs:build

# navigate into the build output directory
cd docs/.vitepress/dist

# if you are deploying to a custom domain
# echo 'www.example.com' > CNAME

git init
git add -A
git commit -m 'deploy'

git push -f git@github.com:wychrist/congregate_theme.git main:gh-pages

cd -
