# Markovchain
MeCabを使用したマルコフ連鎖のPHPライブラリ

### Usage

Basic example:

```php
$mc = new YuzuruS\Markovchain();
$text = '繁栄を築き上げた人類は、突如出現した“天敵”「巨人」により滅亡の淵に立たされた。生き残った人類は、「ウォール・マリア」、「ウォール・ローゼ」、「ウォール・シーナ」という巨大な三重の城壁の内側に生活圏を確保することで、辛うじてその命脈を保っていた。城壁による平和を得てから約100年後。いつしか人類は巨人の脅威を忘れ、平和な日々の生活に埋没していた。';
$mackovText = $mc->makeMarkovText($text);
```
### Installation

This Lib use [MeCab](http://mecab.googlecode.com/svn/trunk/mecab/doc/index.html)
At First, You must install MeCab.
And install this Lib.

```
 composer require 'yuzuru-s/markovchain:dev-master'
```

### License

Licensed under The MIT License

Developed by YUZURU SUZUKI
