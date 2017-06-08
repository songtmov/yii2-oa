<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Customer as CustomerModel;
use common\models\CStore;

/**
 * Customer represents the model behind the search form about `common\models\Customer`.
 */
class Customer extends CustomerModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'age', 'sex', 'source', 'telephone', 'updated_time'], 'integer'],
            [['client_name', 'store_id', 'member_card', 'remark', 'sale_id', 'service_id','cstore_id'], 'safe'],
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
        $query = CustomerModel::find();
        
        $query->joinWith('store')->joinWith('service');

        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20; 

        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' =>  ['pageSize' => $pageSize,],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'age' => $this->age,
            'sex' => $this->sex,
            'source' => $this->source,
            'sale_id' => $this->sale_id,
            // 'service_id' => $this->service_id,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
            'cstore_id' => $this->cstore_id,
        ]);
        
        $query->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', '{{%store}}.name', $this->store_id])
            ->andFilterWhere(['like', '{{%user}}.username', $this->sale_id])
            ->andFilterWhere(['like', '{{%user}}.username', $this->service_id])
            ->andFilterWhere(['like', 'member_card', $this->member_card])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        
        return $dataProvider;
    }
}
