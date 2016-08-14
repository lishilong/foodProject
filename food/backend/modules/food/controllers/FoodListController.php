<?php

namespace backend\modules\food\controllers;

use common\helper\DateTimeHelper;
use Yii;
use common\models\food\FoodList;
use backend\models\food\FoodList as FoodListSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FoodListController implements the CRUD actions for FoodList model.
 */
class FoodListController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all FoodList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FoodListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FoodList model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FoodList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FoodList();

        if ($model->load(Yii::$app->request->post())) {
            $suffName = $this->uploadImageOne('FoodList', 'image');
            if ($suffName) {
                $model->image = '/uploads/image/' . date('Ymd', time()) . '/' . $suffName;
            } else {
                $model->image = $_POST['image'];
            }
            $model->creater = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
            return $this->render('create', [
                'model' => $model,
            ]);

    }

    /**
     * 上传一张图片
     * @param $table
     * @param $attr
     * @return bool|string
     */
    public function uploadImageOne($table, $attr)
    {
        $files = $_FILES[$table];
        //1、判断错误号
        $error = $files['error'][$attr];//获得的错误号
        if ($error != 0) {
            return false;
        }

        //2、判断mime类型
        $mime = $files['type'][$attr];//获得上传的mime类型
        $allowMime = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');//常用的允许上传的mime类型
        if (!in_array($mime, $allowMime)) {
            return false;
        }

        //3、判断后缀名
        $fileName = $files['name'][$attr];//上传的文件名
        $ext = strtolower(pathinfo($fileName)['extension']);//获得后缀名并转化为小写
        $allowExt = array('jpeg', 'jpg', 'gif', 'png');//允许上传的文件后缀类型
        if (!in_array($ext, $allowExt)) {
            return false;
        }

        //4、判断上传的大小
        $size = $files['size'][$attr];
        $allowSize = 1024 * 1024 * 4;//允许的大小

        if ($size > $allowSize) {
            return false;
        }

        //5、判断是否通过HTTP POST方法上传的
        if (!is_uploaded_file($files['tmp_name'][$attr])) {
            return false;
        }
        $upload_path = \Yii::getAlias('@webroot') . "/uploads/image/" . date('Ymd', time()) . '/'; //上传文件的存放路径
        if (!file_exists($upload_path) && !mkdir($upload_path, 0777, true)) {
            return false;
        }
        $suffName = date('YmdHis') . rand(0, 1000) . '.' . $ext;//生成随机文件名
        $res = move_uploaded_file($files['tmp_name'][$attr], $upload_path . $suffName);
        if ($res) {
            return $suffName;
        } else {
            return false;
        }
    }
    /**
     * Updates an existing FoodList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $suffName = $this->uploadImageOne('FoodList', 'image');
            if ($suffName) {
                $model->image = '/uploads/image/' . date('Ymd', time()) . '/' . $suffName;
            } else {
                $model->image = $_POST['image'];
            }
            $model->creater = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
            return $this->render('update', [
                'model' => $model,
            ]);

    }

    /**
     * Deletes an existing FoodList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->isDelete = 1;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the FoodList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FoodList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FoodList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
