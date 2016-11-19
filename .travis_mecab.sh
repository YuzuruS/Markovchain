#!/bin/bash
# install phpredis extension.

set -e

git clone https://github.com/rsky/php-mecab

cd php-mecab/mecab
phpize
./configure
make
sudo make install

echo "extension=mecab.so" > mecab.ini
phpenv config-add mecab.ini

cd ../../