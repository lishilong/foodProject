<?php

namespace rest\modules\food\controllers;

use common\models\food\FoodDetailedList;
use common\models\JsonMessage;
use rest\controllers\RestfulBaseController;
use Yii;
use yii\web\ServerErrorHttpException;


/**
 * Class CurrentAccountController
 * @package rest\modules\v1\controllers
 */
class MainListController extends RestfulBaseController
{

    /**
     * @SWG\Get(
     *     path="main-lists",
     *     summary="详细菜单",
     *     tags={"详细菜单"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *            response="200",
     *            description="成功"),
     *      @SWG\Response(
     *         response="201",
     *         description="失败",
     *     ),
     * security={{"petstore_auth": {"write:CurrentAccounts", "read:CurrentAccounts"}}
     *     }
     * )
     */

    /**
     * 详细菜单
     * @return FoodDetailedList
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function  actionIndex()
    {
        $result = new JsonMessage();
        $model = FoodDetailedList::find()->where(['isDelete' => 0])->all();
        if(empty($model))
        {
            $result->success = false;
            $result->message = '菜单为空';
        }else{
            $result->success = false;
            $result->message = $model;
        }
        return $result;
    }

}
