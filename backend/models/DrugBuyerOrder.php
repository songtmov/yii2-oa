<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DrugBuyerOrder as DrugBuyerOrderModel;

/**
 * DrugBuyerOrder represents the model behind the search form about `common\models\DrugBuyerOrder`.
 */
class DrugBuyerOrder extends DrugBuyerOrderModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'applicant_id', 'buyer_id', 'created_time', 'updated_time'], 'integer'],
            [['buyer_number','store_id'], 'safe'],
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
        $query = DrugBuyerOrderModel::find();
        $query->joinWith('store');

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
            'status' => $this->status,
            'applicant_id' => $this->applicant_id,
            'buyer_id' => $this->buyer_id,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query
        ->andFilterWhere(['like', 'buyer_number', $this->buyer_number])
        ->andFilterWhere(['like','{{%store}}.name',$this->store_id])
        ;

        return $dataProvider;
    }
}
