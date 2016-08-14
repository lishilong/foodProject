<?php

namespace common\helper;
/**
 * Created by PhpStorm.
 * User: yangjie
 * Date: 15/8/4
 * Time: 下午11:56
 */

class UTF8Util
{
    /**
     * utf8字符串转转数组
     * @param $utf8_str
     * @return mixed
     */
    public static function get_chars($utf8_str)
    {
        preg_match_all("/./u",$utf8_str,$arr);
        return $arr[0];
    }
}