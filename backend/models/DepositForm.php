<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DepositForm as DepositFormModel;

/**
 * DepositForm represents the model behind the search form about `common\models\DepositForm`.
 */
class DepositForm extends DepositFormModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'billing_id', 'user_id'], 'integer'],
            [['deposit'], 'number'],
            [['payment_method', 'nbackup', 'sub_time'], 'safe'],
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
        $query = DepositFormModel::find();

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
            'deposit' => $this->deposit,
            'user_id' => $this->user_id,
            'sub_time' => $this->sub_time,
        ]);

        $query->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'nbackup', $this->nbackup]);

        return $dataProvider;
    }
}
