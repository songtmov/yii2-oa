<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Evection as EvectionModel;

/**
 * Evection represents the model behind the search form about `common\models\Evection`.
 */
class Evection extends EvectionModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city', 'updated_time'], 'integer'],
            [['evection_reason', 'evection_info', 'evection_img'], 'safe'],
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
        $query = EvectionModel::find();
        
        // add conditions that should always apply here
        // $dataProvider = new ActiveDataProvider([
        //    'query' => $query,
        // ]);
        
        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20; //默认20
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>  ['pageSize' => $pageSize]
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
            'province' => $this->province,
            'city' => $this->city,
            'user_id' => $this->user_id,
            'store_id' => $this->store_id,
            'evection_time' => $this->evection_time,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);
        
        $query->andFilterWhere(['like', 'evection_reason', $this->evection_reason])
            ->andFilterWhere(['like', 'evection_info', $this->evection_info])
            ->andFilterWhere(['like', 'evection_img', $this->evection_img]);
        
        return $dataProvider;
    }
}
