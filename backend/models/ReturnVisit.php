<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReturnVisit as ReturnVisitModel;

/**
 * ReturnVisit represents the model behind the search form about `common\models\ReturnVisit`.
 */
class ReturnVisit extends ReturnVisitModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visit_id', 'client_id', 'client_status', 'mode', 'is_satisfied', 'health', 'status', 'created_time', 'updated_time'], 'integer'],
            [['visit_content', 'response'], 'safe'],
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
        $query = ReturnVisitModel::find();

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
            'visit_id' => $this->visit_id,
            'client_id' => $this->client_id,
            'client_status' => $this->client_status,
            'mode' => $this->mode,
            'is_satisfied' => $this->is_satisfied,
            'health' => $this->health,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'visit_content', $this->visit_content])
            ->andFilterWhere(['like', 'response', $this->response]);

        return $dataProvider;
    }
}
