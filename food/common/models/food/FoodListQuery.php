<?php

namespace common\models\food;

/**
 * This is the ActiveQuery class for [[FoodList]].
 *
 * @see FoodList
 */
class FoodListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FoodList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FoodList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}