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
class ChildListController extends RestfulBaseController
{

    /**
     * @SWG\Get(
     *     path="child-lists",
     *     summary="菜单",
     *     tags={"菜单"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="foodListId",
     *         in="query",
     *         description="菜系ID",
     *         required=true,
     *         type="integer"
     *     ),
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
     * 菜系
     * @return FoodList
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function  actionIndex()
    {
        $foodListId = Yii::$app->request->get('foodListId');
        $result = new JsonMessage();
        $result->success = false;
        $result->message = '菜单为空';
        if(!empty($foodListId))
        {
           $food = FoodList::find()->where(['id' => $foodListId,'isDelete' => 0])->one();
           if(!empty($food))
           {
               $food->total += 1 ;
               $food->save();
               $foodList = FoodDetailedList::find()->where(['foodListId' => $foodListId])->all();
               if(!empty($foodList))
               {
                   $result->success = true;
                   $result->message = $foodList;
               }
           }

        }
        return $result;

    }

}
