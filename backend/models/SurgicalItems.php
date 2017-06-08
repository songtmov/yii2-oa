<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SurgicalItems as SurgicalItemsModel;

/**
 * SurgicalItems represents the model behind the search form about `common\models\SurgicalItems`.
 */
class SurgicalItems extends SurgicalItemsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'sort', 'status', 'created_time'], 'integer'],
            [['entry_name', 'store_id'], 'safe'],
            [['guide_price'], 'number'],
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
        $query = SurgicalItemsModel::find();
        $query->joinWith('store');
//        $query->joinWith('parent');

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

            'guide_price' => $this->guide_price,
            'sort' => $this->sort,

            'status' => $this->status,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'entry_name', $this->entry_name])
//              ->andFilterWhere(['like', '{{%surgical_items}}.entry_name', $this->parent_id])
              ->andFilterWhere(['like', '{{%store}}.name', $this->store_id]);

        return $dataProvider;
    }
}
