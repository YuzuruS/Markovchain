<?php
namespace YuzuruS\Markovchain;
class Markovchain {

    private $kuten_num = 0;
    private $pre = null;
    private $head = [];
    private $max_wakati_words = 512;

/**
 * makeMarkovText
 * 入力されたテキストを元にマルコフ連鎖を利用しテキストを作成します。
 *
 * @param string $text
 * @access public
 * @return string   $text
 */
    public function makeMarkovText ($text) {
        $text = preg_replace('/(\n|　|\s)/', '', $text);

        $words = $this->makeWakatikakiText($text);
        if (count($words) < 2) {
            return false;
        }

        $table = $this->buildTable($words);
        return $this->buildSentense($table);
    }

/**
 * makeWakatikakiText
 * 分かち書きした単語リスト作成
 * 
 * @param string $text
 * @access public
 * @return array 分かち書きした単語リスト
 */
    public function makeWakatikakiText ($text) {
        $wakatikakiText = `echo '${text}' | mecab -Owakati`;
        $this->kuten_num = substr_count($wakatikakiText, '。');
        $words = explode(' ', $wakatikakiText);
        $words[] = '\n';
        return $words;
    }

/**
 * buildTable
 * マルコフ連鎖用テーブルを作成
 * @param array $words 単語リスト
 * @access public
 * @return array マルコフ連鎖用単語テーブル
 */
    public function buildTable ($words) {
        foreach ($words as $word) {
            if ($this->pre === null) {
                $this->pre = $word;
                $this->head[] = $word;
            } else {
                $markov[$this->pre][] = $word;
                $this->pre = $word;
            }
        }
        return $markov;
    }

/**
 * buildSentense
 * 単語テーブルを元にマルコフ連鎖で文字列を構築する
 * @param array $table_markov マルコフ連鎖用単語テーブル
 * @access public
 * @return string マルコフ連鎖で構築された文字列
 */
    public function buildSentense ( $table_markov ) {
        $result = $this->pre = $this->head[array_rand($this->head)];

        // 文字列を生成
        $kuten_num = 0;
        for($i=0 ; $i < $this->max_wakati_words; $i++) {
            $this->pre = $table_markov[$this->pre][array_rand($table_markov[$this->pre])];
            if ($this->pre==="\n") {
                break;
            }
            $result .= $this->pre;

            // 句点の数を確認
            if ($this->pre === '。') {
                $kuten_num++;
                if($kuten_num === $this->kuten_num) {
                    break;
                }
            }
        }
        return $result;
    }
}
