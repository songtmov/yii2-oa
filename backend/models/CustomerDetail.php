<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerDetail as CustomerDetailModel;

/**
 * CustomerDetail represents the model behind the search form about `common\models\CustomerDetail`.
 */
class CustomerDetail extends CustomerDetailModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'years', 'buy_type', 'is_old_customer'], 'integer'],
            [['filecode', 'customer_birthday', 'husband_birthday', 'merry_day', 'children_birthday', 'customer_nature', 'pay_times', 'habit', 'attitude', 'emotion', 'care_about', 'hobby', 'healthy', 'plastic_items', 'plastic_part', 'attidute', 'hospital', 'old_manner', 'all_evaluate', 'backup'], 'safe'],
            [['total_sals'], 'number'],
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
        $query = CustomerDetailModel::find();

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
            'customer_birthday' => $this->customer_birthday,
            'husband_birthday' => $this->husband_birthday,
            'merry_day' => $this->merry_day,
            'children_birthday' => $this->children_birthday,
            'years' => $this->years,
            'total_sals' => $this->total_sals,
            'buy_type' => $this->buy_type,
            'is_old_customer' => $this->is_old_customer,
        ]);
        
        $query->andFilterWhere(['like', 'filecode', $this->filecode])
            ->andFilterWhere(['like', 'customer_nature', $this->customer_nature])
            ->andFilterWhere(['like', 'pay_times', $this->pay_times])
            ->andFilterWhere(['like', 'habit', $this->habit])
            ->andFilterWhere(['like', 'attitude', $this->attitude])
            ->andFilterWhere(['like', 'emotion', $this->emotion])
            ->andFilterWhere(['like', 'care_about', $this->care_about])
            ->andFilterWhere(['like', 'hobby', $this->hobby])
            ->andFilterWhere(['like', 'healthy', $this->healthy])
            ->andFilterWhere(['like', 'plastic_items', $this->plastic_items])
            ->andFilterWhere(['like', 'plastic_part', $this->plastic_part])
            ->andFilterWhere(['like', 'attidute', $this->attidute])
            ->andFilterWhere(['like', 'hospital', $this->hospital])
            ->andFilterWhere(['like', 'old_manner', $this->old_manner])
            ->andFilterWhere(['like', 'all_evaluate', $this->all_evaluate])
            ->andFilterWhere(['like', 'backup', $this->backup]);

        return $dataProvider;
    }
}
