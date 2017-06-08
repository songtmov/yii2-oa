<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerVisit as CustomerVisitModel;

/**
 * CustomerVisit represents the model behind the search form about `common\models\CustomerVisit`.
 */
class CustomerVisit extends CustomerVisitModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'status', 'cause', 'service_id', 'to_store_time'], 'integer'],
            [['details'], 'safe'],
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
       if(isset($_GET['id'])){
           $query = CustomerVisitModel::find()->where(['customer_id'=>Yii::$app->request->get('id')])->orderBy('status');
       }else{
           $query = CustomerVisitModel::find()->orderBy('status');
       }



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
            'cause' => $this->cause,
            'service_id' => $this->service_id,
            'to_store_time' => $this->to_store_time,
        ]);

        $query->andFilterWhere(['like', 'details', $this->details]);

        return $dataProvider;
    }
}
