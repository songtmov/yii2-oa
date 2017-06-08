<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Meet as MeetModel;

/**
 * Meet represents the model behind the search form about `common\models\Meet`.
 */
class Meet extends MeetModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time', 'hotel_time'], 'integer'],
            [['name', 'space', 'address', 'remark', 'test_list', 'train'], 'safe'],
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
        $query = MeetModel::find();

        // add conditions that should always apply here
        // $dataProvider = new ActiveDataProvider([
        // 'query' => $query,
        // ]);
        
        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 10; //默认20
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' =>  ['pageSize' => $pageSize,],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // 取消下列行，如果你不想返回任何记录验证失败时
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions网格过滤条件 --- 漏斗搜索
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'space', $this->space])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'test_list', $this->test_list])
            ->andFilterWhere(['like', 'train', $this->train]);
        return $dataProvider;
    }
}
