<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerProfiles as CustomerProfilesModel;

/**
 * CustomerProfiles represents the model behind the search form about `common\models\CustomerProfiles`.
 */
class CustomerProfiles extends CustomerProfilesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id', 'customer_id', 'is_clear', 'change_clothes', 'skin_preparation', 'remove_jewelry', 'pathway', 'nuresID', 'hepatitis_B', 'hepatitis_C', 'AIDS', 'syphilis', 'blood_sugar'], 'integer'],
            [['billing_id'], 'integer'],
            [['billing_id'], 'safe'],
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
        $query = CustomerProfilesModel::find();

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
            'surger_date' => $this->surger_date,
            'starting_time' => $this->starting_time,
            'finishing_time' => $this->finishing_time,
            'is_clear' => $this->is_clear,
            'change_clothes' => $this->change_clothes,
            'skin_preparation' => $this->skin_preparation,
            'remove_jewelry' => $this->remove_jewelry,
            'pathway' => $this->pathway,
            'transfusion_time' => $this->transfusion_time,
            'nuresID' => $this->nuresID,
            'hepatitis_B' => $this->hepatitis_B,
            'hepatitis_C' => $this->hepatitis_C,
            'AIDS' => $this->AIDS,
            'syphilis' => $this->syphilis,
            'blood_sugar' => $this->blood_sugar,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'billing_id', $this->billing_id])
            ->andFilterWhere(['like', 'dignosis_before', $this->dignosis_before])
            ->andFilterWhere(['like', 'type_of_anesthesia', $this->type_of_anesthesia])
            ->andFilterWhere(['like', 'anesesiologistID', $this->anesesiologistID])
            ->andFilterWhere(['like', 'medicine_name', $this->medicine_name])
            ->andFilterWhere(['like', 'medicine_specification', $this->medicine_specification]);

        return $dataProvider;
    }
}
