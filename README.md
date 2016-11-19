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
$text = 'ある村むらから、毎日まいにち町まちへ仕事しごとにいく男おとこがありました。どんな日ひでも、さびしい道みちを歩あるかなければならなかったのです。ある日ひのこと、男おとこはいつものごとく考かんがえながら歩あるいてきました。寒さむい朝あさで、自分じぶんの口くちや、鼻はなから出でる息いきが白しろく凍こおって見みえました。また田圃たんぼには、霜しもが真まっ白しろに降おりていて、ちょうど雪ゆきの降ふったような、ながめでありました。';
echo $mc->makeMarkovText($text);
```

OUTPUT

```
ある村むらから、ちょうど雪ゆきのごとく考かんがえながら歩あるいてきました。寒さむい朝あさで、さびしい道みちを歩あるかなければならなかったの口くちや、毎日まいに降ふった。ある村むらから、鼻は、鼻はなから出でる息いきが白しろく凍こおっていて、ちょうど雪ゆきのごとく考かんがえながら歩ある日ひでも、毎日まいには、男おとこはなから出でる息いきが白しろく凍こおってきました。ある日ひのごとく考かんがえながら歩あるいて、ちょうど雪ゆきの降おりていていて見みえました。
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
