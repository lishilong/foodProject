<?php

namespace backend\models\food;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\food\FoodDetailedList;

/**
 * DetailedList represents the model behind the search form about `common\models\food\FoodDetailedList`.
 */
class DetailedList extends FoodDetailedList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'foodListId','creater', 'isDelete'], 'integer'],
            [['name', 'image'], 'safe'],
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
        $query = FoodDetailedList::find();

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
            'foodListId' => $this->foodListId,
            'creater' => $this->creater,
            'isDelete' => $this->isDelete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
