#!/bin/bash

#Some colors
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

printf "\n${GREEN}Checking for the updates from repository...${NC}\n\n"
git checkout master
git stash
git pull origin master

printf "\n${GREEN}Updating composer dependencies...${NC}\n\n"
./composer.phar update

printf "\n${GREEN}Done. Don't forget to update database!${NC}\n\n"