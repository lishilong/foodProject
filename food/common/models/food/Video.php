<?php

namespace common\models\food;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property string $video
 * @property string $describe
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video', 'describe'], 'required'],
            [['video','image'], 'string', 'max' => 100],
            [[ 'isDelete'], 'integer'],
            [['describe'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video' => '视频',
            'describe' => '描述',
            'isDelete' => '是否删除',
            'image' => '图片'
        ];
    }

    /**
     * @inheritdoc
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }


    public function videoList()
    {
        $model = Video::find()->where(['isDelete' => 0])->all();
        if(empty($model))
        {
            return [];
        }
        return $model;
    }
}
