PHP Library that made TEXT of Markovchain for Japanese by MeCab
=============================

[![Coverage Status](https://coveralls.io/repos/github/YuzuruS/Markovchain/badge.svg?branch=master)](https://coveralls.io/github/YuzuruS/Markovchain?branch=master)
[![Build Status](https://travis-ci.org/YuzuruS/Markovchain.png?branch=master)](https://travis-ci.org/YuzuruS/Markovchain)
[![Stable Version](https://poser.pugx.org/yuzuru-s/Markovchain/v/stable)](https://packagist.org/packages/yuzuru-s/Markovchain)
[![Download Count](https://poser.pugx.org/yuzuru-s/Markovchain/downloads.png)](https://packagist.org/packages/yuzuru-s/redis-recommend)

Requirements
-----------------------------
- Mecab
- PhpMecab extension
  - https://github.com:rsky/php-mecab.git
- PHP
  - >=5.5 >=5.6, >=7.0
- Composer



Installation
----------------------------

* Using composer

```
{
    "require": {
       "yuzuru-s/markovchain": "1.0.*"
    }
}
```

```
$ php composer.phar update yuzuru-s/markovchain --dev
```

How to use
----------------------------
Please check [sample code](https://github.com/YuzuruS/markovchain/blob/master/sample/usecase.php)

```php
require __DIR__ . '/vendor/autoload.php';
use YuzuruS\Mecab\Markovchain;

$mc = new Markovchain();
$text = '繁栄を築き上げた人類は、突如出現した“天敵”「巨人」により滅亡の淵に立たされた。生き残った人類は、「ウォール・マリア」、「ウォール・ローゼ」、「ウォール・シーナ」という巨大な三重の城壁の内側に生活圏を確保することで、辛うじてその命脈を保っていた。城壁による平和を得てから約100年後。いつしか人類は巨人の脅威を忘れ、平和な日々の生活に埋没していた。';
echo $mc->makeMarkovText($text);
```


How to run unit test
----------------------------

Run with default setting.
```
% vendor/bin/phpunit -c phpunit.xml.dist
```

Currently tested with PHP 7.0.0


History
----------------------------




License
----------------------------
Copyright (c) 2016 YUZURU SUZUKI. See MIT-LICENSE for further details.

Copyright
-----------------------------
- Yuzuru Suzuki
  - http://yuzurus.hatenablog.jp/
