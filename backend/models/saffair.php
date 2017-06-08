<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\saffair as saffairModel;

/**
 * saffair represents the model behind the search form about `common\models\saffair`.
 */
class saffair extends saffairModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'appointment_type', 'doctor'], 'integer'],
            [['customer', 'province', 'city', 'area', 'hospital', 'remark','appointment'], 'safe'],
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
        $query = saffairModel::find();
        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20; //默认20
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>  ['pageSize' => $pageSize,],
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'appointment' => $this->appointment,
            'appointment_type' => $this->appointment_type,
            'doctor' => $this->doctor,
        ]);

        $query->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'hospital', $this->hospital])
            ->andFilterWhere(['like', 'remark', $this->remark]);
            
        return $dataProvider;
    }
}
