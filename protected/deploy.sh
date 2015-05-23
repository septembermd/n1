#!/bin/bash

echo "Checking for the updates from repository"
git checkout master
git stash
git pull origin master

echo "Updating dependencies"
./composer.phar update

echo "Done. Don't forget to update database"