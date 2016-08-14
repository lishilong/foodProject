<?php

namespace rest\modules\food\controllers;

use common\models\food\FoodDetailedList;
use common\models\food\FoodList;
use common\models\JsonMessage;
use rest\controllers\RestfulBaseController;
use Yii;
use yii\helpers\VarDumper;
use yii\web\ServerErrorHttpException;


/**
 * Class CurrentAccountController
 * @package rest\modules\v1\controllers
 */
class FullListController extends RestfulBaseController
{

    /**
     * @SWG\Get(
     *     path="full-lists",
     *     summary="列表",
     *     tags={"列表"},
     *     consumes={"application/json"},
     *
     *     @SWG\Response(
     *            response="200",
     *            description="成功"),
     *      @SWG\Response(
     *         response="201",
     *         description="失败",
     *     )
     *
     * )
     */

    /**
     * 列表
     * @return FoodList
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function  actionIndex()
    {
        $result = new JsonMessage();
        $model = new FoodList();
        $list = $model->foodList();
        if(empty($list))
        {
            $result->success = false;
            $result->message = '列表为空';
        }else{
            $array = [];
            foreach($list as $val)
            {
                $childList = FoodDetailedList::find()->where(['isDelete' => 0,'foodListId' => $val['id']])->select('')->asArray()->all();
                $array[] = ['id' => $val['id'],'name' => $val['foodName'],'child' => $childList];
            }
            $result->success = true;
            $result->message = $array;
        }
        return $result;
    }

}
