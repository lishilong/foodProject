<?php

namespace common\models\food;

use Yii;

/**
 * This is the model class for table "food_detailed_list".
 *
 * @property integer $id
 * @property integer $foodListId
 * @property string $name
 * @property string $img
 * @property integer $createTime
 * @property integer $updateTime
 * @property integer $creater
 * @property integer $isDeleate
 */
class FoodDetailedList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_detailed_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foodListId', 'name', 'creater'], 'required'],
            [['foodListId', 'creater', 'isDelete'], 'integer'],
            [['name'], 'string', 'max' => 30],
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
            'foodListId' => '关联菜单ID',
            'name' => '菜名',
            'image' => '图片',
            'creater' => '创建人',
            'isDelete' => '是否删除',
        ];
    }

    /**
     * @inheritdoc
     * @return FoodDetailedListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FoodDetailedListQuery(get_called_class());
    }



    //所有子菜单数据
    public function foodList()
    {
        $model = FoodDetailedList::find()->where(['isDelete' => 0])->all();
        return $model;
    }





    //菜系下的菜单
    public function childList($id)
    {
       $model= FoodDetailedList::find()->where(['isDelete' => 0,'foodListId' => $id])->all();
        if(empty($model))
        {
            return [];
        }
        return $model;
    }



}
