<?php

namespace backend\models\food;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\food\FoodList as FoodListModel;

/**
 * FoodList represents the model behind the search form about `common\models\food\FoodList`.
 */
class FoodList extends FoodListModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'isDelete', 'total', 'creater'], 'integer'],
            [['foodName', 'image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FoodListModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'isDelete' => $this->isDelete,
            'total' => $this->total,
            'creater' => $this->creater,
        ]);

        $query->andFilterWhere(['like', 'foodName', $this->foodName])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
