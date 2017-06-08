<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Leechdom as LeechdomModel;

/**
 * Leechdom represents the model behind the search form about `common\models\Leechdom`.
 */
class Leechdom extends LeechdomModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','stock', 'status', 'stock_warning', 'created_time', 'updated_time'], 'integer'],
            [[ 'number', 'cate_id', 'store_id', 'types', 'standard'], 'safe'],
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
        $query = LeechdomModel::find();
        $query->joinWith('cate')->joinWith('store');

        // add conditions that should always apply here

       $dataProvider = new ActiveDataProvider([
           'query' => $query,
       ]);
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
            'stock' => $this->stock,
            'guide_price' => $this->guide_price,
            '{{%leechdom}}.status' => $this->status,
            'stock_warning' => $this->stock_warning,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'types', $this->types])
            ->andFilterWhere(['like', '{{%category}}.name', $this->cate_id])
            ->andFilterWhere(['like', '{{%store}}.name', $this->store_id])
            ->andFilterWhere(['like', 'standard', $this->standard]);

        return $dataProvider;
    }
}
