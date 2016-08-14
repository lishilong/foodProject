<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;


/**
 * Site controller
 */
class DocController extends Controller
{



    public function actionIndex()
    {

        yii::$app->getResponse()->format=Response::FORMAT_JSON;

        return  \Swagger\scan(Yii::getAlias('@rest/modules/food/controllers'));

    }

}
