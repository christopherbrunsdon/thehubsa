#!/bin/sh

# note: change to create a tag and push to git

rm thehubsa-plugin.zip

git archive --format=zip HEAD -o thehubsa-plugin.zip
