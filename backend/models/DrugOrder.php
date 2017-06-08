<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DrugOrder as DrugOrderModel;

/**
 * DrugOrder represents the model behind the search form about `common\models\DrugOrder`.
 */
class DrugOrder extends DrugOrderModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bill_id', 'status', 'created_time', 'updated_time'], 'integer'],
            [['order_number', 'store_id', 'hakim_id', 'client_id'], 'safe'],
            [['amount'], 'number'],
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
        $query = DrugOrderModel::find();
        $query->joinWith('client')->joinWith('hakim')->joinWith('store');
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
            'bill_id' => $this->bill_id,
            'amount' => $this->amount,
            '{{%drug_order}}.status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query
        ->andFilterWhere(['like', 'order_number', $this->order_number])
        ->andFilterWhere(['like', '{{%store}}.name', $this->store_id])
        ->andFilterWhere(['like', '{{%customer}}.client_name', $this->client_id])
        ->andFilterWhere(['like', '{{%user}}.username', $this->hakim_id])
        ;

        return $dataProvider;
    }
}
