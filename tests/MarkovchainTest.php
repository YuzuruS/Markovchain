<?php
require __DIR__ . '/../vendor/autoload.php';
/**
 * RecommendTest
 *
 * @version $id$
 * @copyright Yuzuru Suzuki
 * @author Yuzuru Suzuki <navitima@gmail.com>
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
use YuzuruS\Mecab\Markovchain;
class MarkovChainTest extends \PHPUnit_Framework_TestCase
{
	public function testMakeMarkovText()
	{
		$samples = [
			'ある村むらから、毎日まいにち町まちへ仕事しごとにいく男おとこがありました。どんな日ひでも、さびしい道みちを歩あるかなければならなかったのです。ある日ひのこと、男おとこはいつものごとく考かんがえながら歩あるいてきました。寒さむい朝あさで、自分じぶんの口くちや、鼻はなから出でる息いきが白しろく凍こおって見みえました。また田圃たんぼには、霜しもが真まっ白しろに降おりていて、ちょうど雪ゆきの降ふったような、ながめでありました。';
			'釣つりの道具どうぐを、しらべようとして、信しん一は、物置小舎ものおきごやの中なかへ入はいって、あちらこちら、かきまわしているうちに、あきかんの中なかに、紙かみにつつんだものが、入はいっているのを見みつけ出だしました。「なんだろうか。」頭あたまを、かしげながら、ほこりに、よごれた紙かみを、あけてみると、べいごまが、六つばかり入はいっていました。信しん一は、急きゅうになつかしいものを、見みいだしたようにしばらくそれに見入みいっていました。そのはずです。一昨年おととしの春はるあたりまで、べいごまが、はやって、これを持もって原はらっぱへ、いったものです。それが、べいのやりとりをするのは、よくないというので、お父とうさんからも、先生せんせいからも、とめられて、ついみんなが、やめてしまったが、ただ記念きねんにしようと思おもって、これだけすてずに、紙かみに包つつんで、しまっておいたことを、思おもい出だしました。',
			'富士',
			'aaaaa',
			'',
		];

		$mc = new MarkovChain();
		$return = $mc->makeMarkovText($samples[0]);
		$this->assertTrue(!empty($return));

		$return = $mc->makeMarkovText($samples[1]);
		$this->assertTrue(!empty($return));

		$return = $mc->makeMarkovText($samples[2]);
		$this->assertTrue(!empty($return));

		$return = $mc->makeMarkovText($samples[3]);
		$this->assertFalse($return);

		$return = $mc->makeMarkovText($samples[4]);
		$this->assertFalse($return);
	}


	public function tearDown()
	{
	}
}
