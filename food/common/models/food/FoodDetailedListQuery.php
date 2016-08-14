<?php

namespace common\models\food;

/**
 * This is the ActiveQuery class for [[FoodDetailedList]].
 *
 * @see FoodDetailedList
 */
class FoodDetailedListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FoodDetailedList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FoodDetailedList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}