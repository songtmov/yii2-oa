<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cstore as CstoreModel;

/**
 * Cstore represents the model behind the search form about `common\models\Cstore`.
 */
class Cstore extends CstoreModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'telephone', 'acreage'], 'integer'],
            [['store_name','adress', 'hospital', 'create_time', 'store_photo', 'boss', 'boss_photo', 'encamp', 'consultation', 'business'], 'safe'],
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
        $query = CstoreModel::find();

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
            'create_time' => $this->create_time,
            'telephone' => $this->telephone,
            'acreage' => $this->acreage,
        ]);

        $query->andFilterWhere(['like', 'store_name', $this->store_name])
            // ->andFilterWhere(['like', 'province', $this->province])
            // ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'hospital', $this->hospital])
            ->andFilterWhere(['like', 'store_photo', $this->store_photo])
            ->andFilterWhere(['like', 'boss', $this->boss])
            ->andFilterWhere(['like', 'boss_photo', $this->boss_photo])
            ->andFilterWhere(['like', 'encamp', $this->encamp])
            ->andFilterWhere(['like', 'consultation', $this->consultation])
            ->andFilterWhere(['like', 'business', $this->business])
            // ->andFilterWhere(['like', 'area', $this->area])
            ;

        return $dataProvider;
    }
}
