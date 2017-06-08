<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderPay as OrderPayModel;

/**
 * OrderPay represents the model behind the search form about `common\models\OrderPay`.
 */
class OrderPay extends OrderPayModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'billing_id', 'isall', 'user_id'], 'integer'],
            [['sum_money'], 'number'],
            [['nbackup', 'sub_time', 'payment_method'], 'safe'],
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
        $query = OrderPayModel::find();

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
            'billing_id' => $this->billing_id,
            'isall' => $this->isall,
            'sum_money' => $this->sum_money,
            'user_id' => $this->user_id,
            'sub_time' => $this->sub_time,
        ]);

        $query->andFilterWhere(['like', 'nbackup', $this->nbackup])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method]);

        return $dataProvider;
    }
}
