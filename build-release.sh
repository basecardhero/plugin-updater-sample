#!/usr/bin/env bash

if [ $# -lt 3 ]; then
	echo "usage: $0 <plugin-slug> <source-path> <destination-directory> <version> [ignore-file-path]"
	echo " "
	echo "Example: /bin/bash build-release.sh my-plugin ./ ~/Desktop 0.1.0"
	echo " "
	exit 1
fi

FILE_SLUG=$1
SOURCE_PATH=$2
DESTINATION_DIR=$3
VERSION=$4
IGNORE_FILE_PATH=${5-.distignore}
VERSIONED_FILE_SLUG="$FILE_SLUG.$VERSION"

if [ -z $VERSION ]; then
	echo " "
	echo "Version cannot be empty."
	echo " "
	exit 1
fi

if [ -d "$DESTINATION_DIR/$FILE_SLUG" ]; then
	rm -r "$DESTINATION_DIR/$FILE_SLUG"
fi

mkdir -p $DESTINATION_DIR

if [ -f "package.json" ]; then
	npm run build
fi

rsync -uavz --exclude-from="$IGNORE_FILE_PATH" $SOURCE_PATH "$DESTINATION_DIR/$FILE_SLUG"

cd "$DESTINATION_DIR"

zip -rv -X "$(pwd)/$VERSIONED_FILE_SLUG.zip" "./$FILE_SLUG"

exit 0
