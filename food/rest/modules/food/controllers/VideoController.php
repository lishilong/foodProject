<?php

namespace rest\modules\food\controllers;

use common\models\food\FoodDetailedList;
use common\models\food\FoodList;
use common\models\food\Video;
use common\models\JsonMessage;
use rest\controllers\RestfulBaseController;
use Yii;
use yii\web\ServerErrorHttpException;


/**
 * Class CurrentAccountController
 * @package rest\modules\v1\controllers
 */
class VideoController extends RestfulBaseController
{

    /**
     * @SWG\Get(
     *     path="videos",
     *     summary="视频",
     *     tags={"视频"},
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
     * 视频
     * @return Video
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function  actionIndex()
    {
        $result = new JsonMessage();
        $model = new Video();
        $modelList = $model->videoList();

        if(empty($model))
        {
            $result->success = false;
            $result->message = '视频为空';
        }else{
            $result->success = false;
            $result->message = $modelList;
        }
        return $result;
    }

}
