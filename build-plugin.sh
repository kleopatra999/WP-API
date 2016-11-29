#!/bin/sh

base=${PWD##*/}

cd ..
rm rest-api.zip
zip -r rest-api.zip $base -x ".*" -x "*/.*"

