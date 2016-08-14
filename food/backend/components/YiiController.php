<?php
namespace app\components;

use common\models\JsonMessage;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 * @property array $Layout_data 布局数据.
 */
class YiiController extends Controller
{

    /**
     * Return data to browser as JSON
     * @param $data
     * @throws \yii\base\ExitException
     */
    protected function renderJSON($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $jsoncallback = Yii::$app->request->getQueryParam('jsoncallback');
        //jsonp
        if (isset($jsoncallback)) {
            Yii::$app->response->format = Response::FORMAT_JSONP;
            return  $jsoncallback . '(' . JSON::encode($data) . ')';
        } else {
           return $data;
        }
    }

    /**  not found
     * @param string $message
     * @param int $code
     * @throws HttpException
     */
    protected function  notFound($message = '', $code = 404)
    {
        if (!Yii::$app->request->isAjax) {
            if (empty($message)) {
                throw new HttpException(404, 'The requested page does not exist.');
            } else {
                throw new HttpException($code, $message);
            }

        }

        $jsonResult = new JsonMessage();
        if (empty($message)) {
            $jsonResult->message = 'The requested page does not exist.';
        } else {
            $jsonResult->message = $message;
        }
       return   $this->renderJSON($jsonResult);
    }

    /**
     * 是否已登录
     *
     */
    public function   isLogin()
    {
        return !Yii::$app->user->isGuest;

    }

}