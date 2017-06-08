<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerFollow as CustomerFollowModel;

/**
 * CustomerFollow represents the model behind the search form about `common\models\CustomerFollow`.
 */
class CustomerFollow extends CustomerFollowModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'user_id'], 'integer'],
            [['follow_mode', 'details', 'fail_resource', 'sub_time'], 'safe'],
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
        $query = CustomerFollowModel::find();

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
            'customer_id' => $this->customer_id,
            'user_id' => $this->user_id,
            'sub_time' => $this->sub_time,
        ]);

        $query->andFilterWhere(['like', 'follow_mode', $this->follow_mode])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'fail_resource', $this->fail_resource]);

        return $dataProvider;
    }
}
