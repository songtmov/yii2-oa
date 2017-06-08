<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Department as DepartmentModel;

/**
 * Department represents the model behind the search form about `common\models\Department`.
 */
class Department extends DepartmentModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'found_time'], 'integer'],
            [['name'], 'safe'],
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
        $query = DepartmentModel::find();
        
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
            'status' => $this->status,
            'found_time' => $this->found_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
