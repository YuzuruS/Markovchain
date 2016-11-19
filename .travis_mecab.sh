#!/bin/bash
# install php-mecab extension.

set -e

git clone git@github.com:rsky/php-mecab.git

cd php-mecab/mecab
phpize
./configure
make
make test
sudo make install

echo "extension=mecab.so" > mecab.ini
phpenv config-add mecab.ini