<?php

namespace rest\modules\food\controllers;

use common\models\food\FoodDetailedList;
use common\models\food\FoodList;
use common\models\JsonMessage;
use rest\controllers\RestfulBaseController;
use Yii;
use yii\web\ServerErrorHttpException;


/**
 * Class CurrentAccountController
 * @package rest\modules\v1\controllers
 */
class ListController extends RestfulBaseController
{

    /**
     * @SWG\Get(
     *     path="lists",
     *     summary="菜系",
     *     tags={"菜系"},
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
     * 菜系
     * @return FoodList
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function  actionIndex()
    {
        $result = new JsonMessage();
        $model = new FoodList();
        $modelList = $model->foodList();

        if(empty($model))
        {
            $result->success = false;
            $result->message = '菜系为空';
        }else{
            $result->success = false;
            $result->message = $modelList;
        }
        return $result;
    }

}
