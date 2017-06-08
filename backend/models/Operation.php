<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BillingOperation;

/**
 * Operation represents the model behind the search form about `common\models\BillingOperation`.
 */
class Operation extends BillingOperation
{


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',
             // 'client_id' , 
             // 'surgical_id', 
             // 'hakim_id', 
             // 'assistant_id', 
             // 'nurse_id',
              // 'counselor_id', 
              // 'store_id', 
              'sale_id', 
              // 'status', 
              
              ], 'integer'],
            [['surgery_cost'], 'number'],
            [['operation_time','created_time'], 'safe'],
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
        $query = BillingOperation::find();

        if(isset($params['Operation']['created_time'])){
            $params['Operation']['created_time'] = strtotime($params['Operation']['created_time']);
        }
        
        if(isset($params['Operation']['created_time']) && $params['Operation']['created_time'] == ''){
            unset($params['Operation']['created_time']);
        }

        // p($params);die;

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

        // $time = strtotime(),

        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            // 'client_id' => $this->client_id,
            // 'surgical_id' => $this->surgical_id,
            // 'hakim_id' => $this->hakim_id,
            // 'assistant_id' => $this->assistant_id,
            // 'nurse_id' => $this->nurse_id,
            'surgery_cost' => $this->surgery_cost,
            // 'counselor_id' => $this->counselor_id,
            // 'store_id' => $this->store_id,
            'sale_id' => $this->sale_id,
            'status' => $this->status,
            'created_time' =>  $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'operation_time', $this->operation_time]);
        
        return $dataProvider;
        // p($dataProvider);die;
    }
}
