<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerRecords as CustomerRecordsModel;

/**
 * CustomerRecords represents the model behind the search form about `common\models\CustomerRecords`.
 */
class CustomerRecords extends CustomerRecordsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visited_id', 'ishealthy', 'service_id'], 'integer'],
            [['pay'], 'number'],
            [['visited_problem', 'after_time', 'operating_position', 'visited_time', 'visited_mode', 'visited_content', 'bed_position', 'customer_detail'], 'safe'],
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
        $query = CustomerRecordsModel::find();

        // add conditions that should always apply here

//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20; //默认20
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' =>  ['pageSize' => $pageSize,],
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
            'pay' => $this->pay,
            'visited_time' => $this->visited_time,
            'visited_id' => $this->visited_id,
            'ishealthy' => $this->ishealthy,
            'service_id' => $this->service_id,
        ]);

        $query->andFilterWhere(['like', 'visited_problem', $this->visited_problem])
            ->andFilterWhere(['like', 'after_time', $this->after_time])
            ->andFilterWhere(['like', 'operating_position', $this->operating_position])
            ->andFilterWhere(['like', 'visited_mode', $this->visited_mode])
            ->andFilterWhere(['like', 'visited_content', $this->visited_content])
            ->andFilterWhere(['like', 'bed_position', $this->bed_position])
            ->andFilterWhere(['like', 'customer_detail', $this->customer_detail]);

        return $dataProvider;
    }
}
