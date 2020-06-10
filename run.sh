#!/bin/sh

WD=`pwd`
PORT=14380

cd www
echo "this application is available at http://localhost:$PORT"
php -S localhost:$PORT _mvp.php
cd $WD
