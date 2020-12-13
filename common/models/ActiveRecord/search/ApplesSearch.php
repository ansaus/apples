<?php

namespace common\models\ActiveRecord\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ActiveRecord\Apples;

/**
 * ApplesSearch represents the model behind the search form of `common\models\ActiveRecord\Apples`.
 */
class ApplesSearch extends Apples
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['color', 'created_date', 'fallen_date', 'status'], 'safe'],
            [['size'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Apples::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_date' => $this->created_date,
            'fallen_date' => $this->fallen_date,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
