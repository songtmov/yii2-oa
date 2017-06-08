<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Overtime as OvertimeModel;

/**
 * Overtime represents the model behind the search form about `common\models\Overtime`.
 */
class Overtime extends OvertimeModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'fill_time'], 'integer'],
            [['work_time', 'work_address', 'work_reason', 'executive_opinion', 'department_opinion', 'manager_opinion'], 'safe'],
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
        $query = OvertimeModel::find();
        
        // add conditions that should always apply here

        // $dataProvider = new ActiveDataProvider([
        //    'query' => $query,
        // ]);
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
            'user_id' => $this->user_id,
            'fill_time' => $this->fill_time,
        ]);

        $query->andFilterWhere(['like', 'work_time', $this->work_time])
            ->andFilterWhere(['like', 'work_address', $this->work_address])
            ->andFilterWhere(['like', 'work_reason', $this->work_reason])
            ->andFilterWhere(['like', 'executive_opinion', $this->executive_opinion])
            ->andFilterWhere(['like', 'department_opinion', $this->department_opinion])
            ->andFilterWhere(['like', 'manager_opinion', $this->manager_opinion]);

        return $dataProvider;
    }
}
