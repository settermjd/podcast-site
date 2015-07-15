#!/bin/bash

# -------------------------------------------------------------------- #
# This is a simple script to ensure that the cache directories are both 
# there and writeable.
#
# It should be fair to assume that the `storage/cache` directory is 
# present, as it's under Git control.
#
# Written by: Matthew Setter <matthew.setter@gmail.com>
# Written on: 15 Jul, 2015.
# -------------------------------------------------------------------- #

CACHEDIR=./storage/cache
APP_CACHEDIR=$CACHEDIR/app-cache
TEMPLATE_CACHEDIR=$CACHEDIR/template-cache

function create_directories()
{
  DIRNAME=$1;

  if [ -z "$DIRNAME" ]; then
    echo "A directory name needs to be supplied";
  fi;

  if [ ! -e "$DIRNAME" ]; then
    echo "Creating cache directory: $DIRNAME";
    mkdir "$DIRNAME";
  fi;
}

function set_permissions()
{
  DIRNAME=$1;

  if [ -z "$DIRNAME" ]; then
    echo "A directory name needs to be supplied";
  fi;

  if [ ! -w $DIRNAME ]; then
    echo "Correcting permissions on cache directory $DIRNAME";
    chmod -R ug+wrx $DIRNAME;
  fi;
}

function empty_cache_directories()
{
  DIRNAME=$1;

  if [ -z "$DIRNAME" ]; then
    echo "A directory name needs to be supplied";
  fi;

  if [ "$(ls -A $DIRNAME)" ]; then
       echo "Cache directory $DIRNAME is not Empty. Emptying...";
       rm -rvf "$DIRNAME/./*"
  fi
}

create_directories $APP_CACHEDIR
create_directories $TEMPLATE_CACHEDIR
