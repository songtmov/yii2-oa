<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DrugOrderDetail as DrugOrderDetailModel;

/**
 * DrugOrderDetail represents the model behind the search form about `common\models\DrugOrderDetail`.
 */
class DrugOrderDetail extends DrugOrderDetailModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'leechdom_id', 'number', 'order_id', 'created_time'], 'integer'],
            [['price'], 'number'],
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
        $id = Yii::$app->request->get('id');
        $query = DrugOrderDetailModel::find()->where(['order_id'=>$id]);

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
            'leechdom_id' => $this->leechdom_id,
            'number' => $this->number,
            'price' => $this->price,
            'order_id' => $this->order_id,
            'created_time' => $this->created_time,
        ]);

        return $dataProvider;
    }
}
