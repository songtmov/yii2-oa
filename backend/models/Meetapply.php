<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\meetapply as meetapplyModel;

/**
 * meetapply represents the model behind the search form about `common\models\meetapply`.
 */
class meetapply extends meetapplyModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_id', 'ma_countpeople', 'ma_createtime', 'ma_delete'], 'integer'],
            [['ma_content', 'ma_meetname', 'ma_department', 'ma_starttime', 'ma_endtime', 'ma_speaker', 'ma_type', 'ma_meetaddress','ma_remark'], 'safe'],
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
        $query = meetapplyModel::find();
        
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
            'ma_id' => $this->ma_id,
            'ma_countpeople' => $this->ma_countpeople,
            'ma_createtime' => $this->ma_createtime,
            // 'ma_uid' => $this->ma_uid,
            // 'ma_mid' => $this->ma_mid,
            'ma_delete' => $this->ma_delete,
        ]);
        
        $query->andFilterWhere(['like', 'ma_content', $this->ma_content])
            ->andFilterWhere(['like', 'ma_meetname', $this->ma_meetname])
            ->andFilterWhere(['like', 'ma_department', $this->ma_department])
            ->andFilterWhere(['like', 'ma_starttime', $this->ma_starttime])
            ->andFilterWhere(['like', 'ma_endtime', $this->ma_endtime])
            ->andFilterWhere(['like', 'ma_speaker', $this->ma_speaker])
            ->andFilterWhere(['like', 'ma_type', $this->ma_type])
            ->andFilterWhere(['like', 'ma_meetaddress', $this->ma_meetaddress])
            ->andFilterWhere(['like', 'ma_remark', $this->ma_remark]);
        return $dataProvider;
    }
}
