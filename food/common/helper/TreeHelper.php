<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2015/11/23
 * Time: 14:44
 */

namespace common\helper;


use yii\helpers\VarDumper;

class TreeHelper {


    public function treefun(&$knowledgePoint, $id,Array &$arr,$level=0)
    {
        $list = from($knowledgePoint)->where(function ($v) use ($id) {
            return $v->pid == $id;
        })->toList();
        if (count($list) > 0) {
            foreach ($list as $ls) {
                $ls->kpointname= str_repeat('　　',$level).'|'.$ls->kpointname;
                $arr[]=$ls;
                $this->treefun($knowledgePoint, $ls->kid,$arr,$level+1);
            }
        }
    }

    public function treePid(&$knowledgePoint,Array &$arr)
    {
       $min=  from($knowledgePoint)->min('$v->pid');
        $list = from($knowledgePoint)->where(function ($v) use ($min) {
            return $v->pid == $min;
        })->toList();
        if (count($list) > 0) {
            foreach ($list as $ls) {
                $this->treefun($knowledgePoint, $ls->kid,$arr);
            }
        }
    }
} 