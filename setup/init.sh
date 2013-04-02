#!/bin/bash

cd "$(dirname ${BASH_SOURCE[0]})"

cd ..

mkdir --mode=0777 ./protected/runtime
mkdir --mode=0777 ./www/assets

echo "DONE"

