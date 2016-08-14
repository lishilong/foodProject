<?php

namespace common\models\food;

use Yii;

/**
 * This is the model class for table "food_list".
 *
 * @property integer $id
 * @property string $foodName
 * @property string $img
 * @property integer $createTime
 * @property integer $updateTime
 * @property integer $isDelete
 * @property integer $total
 * @property integer $creater
 */
class FoodList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foodName'], 'required'],
            [[ 'isDelete', 'total', 'creater'], 'integer'],
            [['foodName'], 'string', 'max' => 30],
            [['image'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'foodName' => '菜单名字',
            'img' => '图片',
            'isDelete' => '是否删除',
            'total' => '点击数量',
            'creater' => '创建人',
        ];
    }

    /**
     * @inheritdoc
     * @return FoodListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FoodListQuery(get_called_class());
    }


    public function foodList()
    {
        $model = FoodList::find()->where(['isDelete' => 0])->all();
        if(empty($model))
        {
            return [];
        }
        return $model;
    }
}
