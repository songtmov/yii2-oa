<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RecordNursing as RecordNursingModel;

/**
 * RecordNursing represents the model behind the search form about `common\models\RecordNursing`.
 */
class RecordNursing extends RecordNursingModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_profiles_id', 'customer_id', 'nurse_id'], 'integer'],
            [['record_date', 'record_time', 'body_tempreture', 'blood_pressure', 'pulse', 'heart_rate', 'create_time'], 'safe'],
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
        $query = RecordNursingModel::find();

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
            'customer_profiles_id' => $this->customer_profiles_id,
            'customer_id' => $this->customer_id,
            'record_date' => $this->record_date,
            'record_time' => $this->record_time,
            'nurse_id' => $this->nurse_id,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'body_tempreture', $this->body_tempreture])
            ->andFilterWhere(['like', 'blood_pressure', $this->blood_pressure])
            ->andFilterWhere(['like', 'pulse', $this->pulse])
            ->andFilterWhere(['like', 'heart_rate', $this->heart_rate]);

        return $dataProvider;
    }
}
