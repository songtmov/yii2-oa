<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Supplies as SuppliesModel;

/**
 * Supplies represents the model behind the search form about `common\models\Supplies`.
 */
class Supplies extends SuppliesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stock', 'status', 'stock_warning'], 'integer'],
            [['name', 'cate_id', 'store_id', 'types'], 'safe'],
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
        $query = SuppliesModel::find();
        $query->joinWith('cate');
        $query->joinWith('store');
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
            'stock' => $this->stock,
            '{{%supplies}}.status' => $this->status,
            'stock_warning' => $this->stock_warning,
        ]);

        $query->andFilterWhere(['like', '{{%supplies}}.name', $this->name])
            ->andFilterWhere(['like', 'types', $this->types])
            ->andFilterWhere(['like', '{{%category}}.name', $this->cate_id])
            ->andFilterWhere(['like', '{{%store}}.name', $this->store_id])
        ;

        return $dataProvider;
    }
}
