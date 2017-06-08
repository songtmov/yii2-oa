<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RecoverService as RecoverServiceModel;

/**
 * RecoverService represents the model behind the search form about `common\models\RecoverService`.
 */
class RecoverService extends RecoverServiceModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'billing_id'], 'integer'],
            [['most_satisfied', 'not_most_satisfied', 'description'], 'safe'],
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
        $query = RecoverServiceModel::find();

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
        ]);

        $query->andFilterWhere(['like', 'most_satisfied', $this->most_satisfied])
            ->andFilterWhere(['like', 'not_most_satisfied', $this->not_most_satisfied])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
