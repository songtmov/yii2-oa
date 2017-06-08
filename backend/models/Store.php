<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Store as StoreModel;

/**
 * Store represents the model behind the search form about `common\models\Store`.
 */
class Store extends StoreModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province', 'city', 'area', 'acreage', 'store_created_time', 'created_time', 'updated_time'], 'integer'],
            [['name', 'head_id', 'address', 'Store_image', 'contact_number'], 'safe'],
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
        $query = StoreModel::find();

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
        $query->joinWith('user');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'acreage' => $this->acreage,
            'store_created_time' => $this->store_created_time,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'Store_image', $this->Store_image])
            ->andFilterWhere(['like', '{{%user}}.username', $this->head_id])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number]);

        return $dataProvider;
    }
}
