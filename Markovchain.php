<?php
class Markovchain {
/**
 * wakatiText
 *
 * MeCabを使って文章を単語に分解する
 * 文章の終りを示す為、最後の要素は空文字列とする
 *
 * #test 正しく分かち書きされた単語リストが得られる事
 * <code>
 * #eq(array('これ','は','ペン','です','。',''), #f('これはペンです。'));
 * </code>
 * #test 引数が空文字列の時は空文字列を1つだけ含む配列を返す事
 * <code>
 * #eq(array(''), #f(''));
 * </code>
 *
 * @param string $text
 * @access public
 * @return array 分かち書きした単語リスト
 */
    public function wakatiText ($text) {
        $words = explode(' ', `echo '${text}' | mecab -Owakati`);
        $words[count($words)-1] = '';
        return $words;
    }

/**
 * buildTable
 *
 * 単語リストからマルコフ連鎖用単語テーブルを作る
 *
 * #test 単語リストが単語3つ＋終端の場合
 * <code>
 * $expects = array(
 *     array('私', 'は', 'カモメ'),
 *     array('は', 'カモメ', ''),
 * );
 * #eq($expects, #f(array('私', 'は', 'カモメ', '')));
 * </code>
 *
 * @param array $words 単語リスト
 * @access public
 * @return array マルコフ連鎖用単語テーブル
 */
    public function buildTable ($words) {
        $table = array();
        for ($i = 0; $i < count($words) - 2; $i++) {
            $table[] = array($words[$i], $words[$i + 1], $words[$i + 2]);
        }
        return $table;
    }

/**
 * buildSentense
 *
 * 単語テーブルを元にマルコフ連鎖で文字列を構築する
 *
 * #test 単語の組み合わせが1通りだけの場合
 * <code>
 * $table_markov = array(
 *     array('私', 'は', 'カモメ'),
 *     array('は', 'カモメ', ''),
 * );
 * #eq('私はカモメ', #f($table_markov));
 * $table_markov = array(
 *     array('私', 'は', 'カモメ'),
 *     array('は', 'カモメ', 'を'),
 *     array('カモメ', 'を', '見た'),
 *     array('を', '見た', ''),
 * );
 * #eq('私はカモメを見た', #f($table_markov));
 * </code>
 * #test 単語の組み合わせが2通りの場合
 * <code>
 * $table_markov = array(
 *     array('私', 'は', 'カモメ'),
 *     array('私', 'は', 'ウミドリ'),
 *     array('は', 'カモメ', ''),
 *     array('は', 'ウミドリ', ''),
 * );
 * $result = #f($table_markov);
 * #true($result === '私はカモメ' || $result === '私はウミドリ');
 * </code>
 *
 * @param array $table_markov マルコフ連鎖用単語テーブル
 * @access public
 * @return string マルコフ連鎖で構築された文字列
 */
    public function buildSentense ( $table_markov ) {
        $key[0] = $table_markov[0][0];
        $key[1] = $table_markov[0][1];

        $result = implode('', $key);
        while (true) {
            $values = $this->_searchAvailableValues($table_markov, $key);
            $value = $values[array_rand($values)];
            if ($value === '') {
                break;
            }
            $result .= $value;
            $key[0] = $key[1];
            $key[1] = $value;
        }
        return $result;
    }

/**
 * _searchAvailableValues
 *
 * マルコフ連鎖で次の値となる候補を検索する
 *
 * #test 候補が1つだけの場合
 * <code>
 * $table = array(
 *     array('私', 'は', 'カモメ'),
 *     array('は', 'カモメ', ''),
 * );
 * $expects = array('カモメ');
 * #eq($expects, #f($table, array('私', 'は')));
 * </code>
 * #test 候補が2つの場合
 * <code>
 * $table = array(
 *     array('私', 'は', 'カモメ'),
 *     array('私', 'は', 'ウミドリ'),
 *     array('は', 'カモメ', ''),
 *     array('は', 'ウミドリ', ''),
 * );
 * $expects = array('カモメ', 'ウミドリ');
 * #eq($expects, #f($table, array('私', 'は')));
 *
 * @param array $table マルコフ連鎖用単語テーブル
 * @param array $key 検索キー
 * @access private
 * @return array マルコフ連鎖の値候補リスト
 */
    private function _searchAvailableValues( $table, $key ) {
        $values = array();
        foreach ( $table as $row ) {
            if ( $row[0] === $key[0] && $row[1] === $key[1] ) {
                $values[] = $row[2];
            }
        }
        return $values;
    }
}