<?php

namespace common\helper;
/**
 * Created by PhpStorm.
 * User: yangjie
 * Date: 15/8/5
 * Time: 上午12:03
 */
class TrieTree
{

    public $tree = array();

    /**
     * @param $utf8_str
     */
    public function insert($utf8_str)
    {
        $chars = UTF8Util::get_chars($utf8_str);
        $chars[] = null;    //串结尾字符
        $count = count($chars);
        $T = &$this->tree;
        for ($i = 0; $i < $count; $i++) {
            $c = $chars[$i];
            if (!array_key_exists($c, $T)) {
                $T[$c] = array();    //插入新字符，关联数组
            }
            $T = &$T[$c];
        }
    }

    /**
     * @param $utf8_str
     */
    public function remove($utf8_str)
    {
        $chars = UTF8Util::get_chars($utf8_str);
        $chars[] = null;
        if ($this->_find($chars)) {    //先保证此串在树中
            $chars[] = null;
            $count = count($chars);
            $T = &$this->tree;
            for ($i = 0; $i < $count; $i++) {
                $c = $chars[$i];
                if (count($T[$c]) == 1) {        //表明仅有此串
                    unset($T[$c]);
                    return;
                }
                $T = &$T[$c];
            }
        }
    }

    /**
     * @param $chars
     * @return bool
     */
    private function _find(&$chars)
    {
        $count = count($chars);
        $T = &$this->tree;
        for ($i = 0; $i < $count; $i++) {
            $c = $chars[$i];
            if (!array_key_exists($c, $T)) {
                return false;
            }
            $T = &$T[$c];
        }
        return true;
    }

    /**
     * @param $utf8_str
     * @return bool
     */
    public function find($utf8_str)
    {
        $chars = UTF8Util::get_chars($utf8_str);
        $chars[] = null;
        return $this->_find($chars);
    }

    /**
     * @param $utf8_str
     * @param int $do_count
     * @return array|bool
     */
    public function contain($utf8_str, $do_count = 0)
    {
        $result = [];
        $result['count'] = 0;
        $result['pos'] = [];
        $chars = UTF8Util::get_chars($utf8_str);
        $chars[] = null;
        $len = count($chars);
        $Tree = &$this->tree;
        $count = 0;
        for ($i = 0; $i < $len; $i++) {
            $c = $chars[$i];
            if (array_key_exists($c, $Tree)) {    //起始字符匹配
                $T = &$Tree[$c];
                for ($j = $i + 1; $j < $len; $j++) {
                    $c = $chars[$j];
                    if (array_key_exists(null, $T)) {
                        if ($do_count) {

                            $count++;
                            $result['count'] = $count;
                            $result['pos'][] = [$i, $j - $i];
                        } else {
                            return true;
                        }
                    }
                    if (!array_key_exists($c, $T)) {
                        break;
                    }
                    $T = &$T[$c];
                }
            }
        }
        if ($do_count) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param $utf8_str
     * @return array|string
     */
    public function  replaceKeyWord($utf8_str)
    {


        $counts = $this->contain($utf8_str, 1);
        array_shift($counts);
        foreach ($counts['pos'] as $v) {
            $utf8_str = $this->mb_substr_replace($utf8_str, str_repeat('*', $v[1]), $v[0], $v[1] - 1);
        }
        return $utf8_str;

    }


    /**
     * @param $string
     * @param $replacement
     * @param $start
     * @param int $length
     * @return array|string
     */
    function mb_substr_replace($string, $replacement, $start, $length = 0)
    {
        if (is_array($string)) {
            foreach ($string as $i => $val) {
                $repl = is_array($replacement) ? $replacement[$i] : $replacement;
                $st = is_array($start) ? $start[$i] : $start;
                $len = is_array($length) ? $length[$i] : $length;

                $string[$i] = $this->mb_substr_replace($val, $repl, $st, $len);
            }

            return $string;
        }

        $result = mb_substr($string, 0, $start, 'UTF-8');
        $result .= $replacement;

        if ($length > 0) {
            $result .= mb_substr($string, ($start + $length + 1), mb_strlen($string, 'UTF-8'), 'UTF-8');
        }

        return $result;
    }

    /**
     * @param $str_array
     * @return bool
     */
    public function contain_all($str_array)
    {
        foreach ($str_array as $str) {
            if ($this->contain($str)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function export()
    {
        return serialize($this->tree);
    }

    /**
     * @param $str
     */
    public function import($str)
    {
        $this->tree = unserialize($str);
    }

}