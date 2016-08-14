<?php

namespace common\models\food;

/**
 * This is the ActiveQuery class for [[Video]].
 *
 * @see Video
 */
class VideoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Video[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Video|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}