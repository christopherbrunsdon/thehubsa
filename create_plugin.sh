#!/bin/bash

echo "Running unit tests"

cd tests

phpunit all.php
# $? is a shell variable which stores the return code from what we just ran
rc=$?

# back to root dir
cd ..

if [[ $rc != 0 ]]; then
	echo "phpunit failed - create plugin denied."
	exit $rc
fi

# note: change to create a tag and push to git
# @TODO: integrate into travisci

echo "Removing old plugin"
rm thehubsa-plugin.zip

echo "Creating new plugin"
git archive --format=zip HEAD -o thehubsa-plugin.zip

echo "Done"
