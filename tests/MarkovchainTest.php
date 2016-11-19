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
			'繁栄を築き上げた人類は、突如出現した“天敵”「巨人」により滅亡の淵に立たされた。生き残った人類は、「ウォール・マリア」、「ウォール・ローゼ」、「ウォール・シーナ」という巨大な三重の城壁の内側に生活圏を確保することで、辛うじてその命脈を保っていた。城壁による平和を得てから約100年後。いつしか人類は巨人の脅威を忘れ、平和な日々の生活に埋没していた。',
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
		$this->assertFalse($return);

		$return = $mc->makeMarkovText($samples[3]);
		$this->assertFalse($return);
	}


	public function tearDown()
	{
	}
}