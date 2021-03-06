<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OutboundOrder as OutboundOrderModel;

/**
 * OutboundOrder represents the model behind the search form about `common\models\OutboundOrder`.
 */
class OutboundOrder extends OutboundOrderModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'billing_id', 'cate_id', 'numbers'], 'integer'],
            [['item_id', 'nbackup', 'submit_time'], 'safe'],
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
        $query = OutboundOrderModel::find();

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
            'cate_id' => $this->cate_id,
            'numbers' => $this->numbers,
            'submit_time' => $this->submit_time,
        ]);

        $query->andFilterWhere(['like', 'item_id', $this->item_id])
            ->andFilterWhere(['like', 'nbackup', $this->nbackup]);

        return $dataProvider;
    }
}
