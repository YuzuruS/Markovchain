<?php
namespace YuzuruS\Mecab;

/**
 * Markovchain
 *
 * @author Yuzuru Suzuki <navitima@gmail.com>
 * @license MIT
 */
class Markovchain {

    private $_kuten_num = 0;
    private $_pre = null;
    private $_head = [];
    private $_max_wakati_words;


    /**
     * Markovchain constructor.
     * @param int $max_wakati_words
     */
    public function __construct($max_wakati_words = 512)
    {
        $this->_max_wakati_words = $max_wakati_words;
    }

    /**
     * makeMarkovText
     * 入力されたテキストを元にマルコフ連鎖を利用しテキストを作成します。
     *
     * @access public
     * @param $text
     * @return bool|string
     */
    public function makeMarkovText($text)
    {
        $text = preg_replace('/(\n|　|\s)/', '', $text);
        if (mb_detect_encoding($text) === 'ASCII') {
            return false;
        }

        $words = $this->_makeWakatikakiText($text);
        if (count($words) < 2) {
            return false;
        }

        $table = $this->_buildTable($words);
        $text = $this->_buildSentense($table);
        $this->_clear();
        return $text;
    }

    /**
     * _clear
     * 変数変数初期化
     */
    private function _clear()
    {
        $this->_kuten_num = 0;
        $this->_pre = null;
        $this->_head = [];
    }

    /**
     * makeWakatikakiText
     * 分かち書きした単語リスト作成
     *
     * @access private
     * @param $text
     * @return array
     */
    private function _makeWakatikakiText($text)
    {
        $options = ['-O', 'wakati'];

        $mecab = new \MeCab\Tagger($options);
        $wakatikakiText = $mecab->parse($text);
        $this->_kuten_num = substr_count($wakatikakiText, '。');
        $words = explode(' ', $wakatikakiText);
        $words[] = '\n';
        return $words;
    }

    /**
     * buildTable
     * マルコフ連鎖用テーブルを作成
     *
     * @access private
     * @param $words
     * @return mixed
     */
    private function _buildTable($words)
    {
        foreach ($words as $word) {
            if ($this->_pre === null) {
                $this->_pre = $word;
                $this->_head[] = $word;
            } else {
                $markov[$this->_pre][] = $word;
                $this->_pre = $word;
            }
        }
        return $markov;
    }

    /**
     * buildSentense
     * 単語テーブルを元にマルコフ連鎖で文字列を構築する
     *
     * @access private
     * @param $table_markov マルコフ連鎖用単語テーブル
     * @return string マルコフ連鎖で構築された文字列
     */
    private function _buildSentense( $table_markov )
    {
        $result = $this->_pre = $this->_head[array_rand($this->_head)];

        // 文字列を生成
        $kuten_num = 0;
        for($i=0 ; $i < $this->_max_wakati_words; $i++) {
            $this->_pre = $table_markov[$this->_pre][array_rand($table_markov[$this->_pre])];
            if ($this->_pre==="\n") {
                break;
            }
            $result .= $this->_pre;

            // 句点の数を確認
            if ($this->_pre === '。') {
                $kuten_num++;
                if($kuten_num === $this->_kuten_num) {
                    break;
                }
            }
        }
        return $result;
    }
}
