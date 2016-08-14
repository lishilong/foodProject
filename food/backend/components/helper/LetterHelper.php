<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-9-2
 * Time: 下午2:38
 */
namespace backend\components\helper;

class LetterHelper {
    /**
     * @param $ranking
     * @return string
     * 对应的数字转化成大写字母
     */
    public static function getLetter($ranking){
        return  chr(65+$ranking);
    }
}