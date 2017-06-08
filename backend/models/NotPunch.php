<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notpunch as NotpunchModel;

/**
 * Notpunch represents the model behind the search form about `common\models\Notpunch`.
 */
class Notpunch extends NotpunchModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'not_punch_interval'], 'integer'],
            [['full_time', 'not_punch_time', 'not_punch_reason', 'depart_opinion', 'manager_opinion'], 'safe'],
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
        $query = NotpunchModel::find();

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
            'full_time' => $this->full_time,
            'user_id' => $this->user_id,
            'not_punch_time' => $this->not_punch_time,
            'not_punch_interval' => $this->not_punch_interval,
        ]);

        $query->andFilterWhere(['like', 'not_punch_reason', $this->not_punch_reason])
            ->andFilterWhere(['like', 'depart_opinion', $this->depart_opinion])
            ->andFilterWhere(['like', 'manager_opinion', $this->manager_opinion]);

        return $dataProvider;
    }
}
