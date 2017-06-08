<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BillingOperation as BillingOperationModel;
use yii\web\BadRequestHttpException;

/**
 * BillingOperation represents the model behind the search form about `common\models\BillingOperation`.
 */
class Arrange extends BillingOperationModel
{
    public $search;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hakim_id', 'assistant_id', 'nurse_id', 'counselor_id', 'sale_id', 'status'], 'integer'],
            [['surgery_cost'], 'number'],
            [[ 'client_id', 'search','operation_time', 'surgical_id', 'store_id', 'created_time'], 'safe'],
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
        if(isset($params['BillingOperation']['search']) && !empty($params['BillingOperation']['search'])){
            $uid = User::find()->asArray()->where(['like','username',$params['BillingOperation']['search']])->one();
            if(empty($uid)){
                throw new BadRequestHttpException('该员工不存在');
            }
        }
        if(isset($params['BillingOperation']['created_time']) && !empty($params['BillingOperation']['created_time'])){
            $time = explode(' - ',$params['BillingOperation']['created_time']);
            $start_time = strtotime($time[0]);
            $end_time = strtotime($time[1]);
        }
        $id = Yii::$app->user->identity->id;

        $query = BillingOperationModel::find()->where(['and',['or',['hakim_id'=>$id],['assistant_id'=>$id],['nurse_id'=>$id]],['{{%billing_operation}}.status'=>168]]);

        $query->joinWith('client')->joinWith('surgical')->joinWith('store');

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

        if(isset($params['BillingOperation']['search']) && !empty($params['BillingOperation']['search']))
        {
            $query->where([
                'or',
                ['=','hakim_id',$uid['id']],
                ['=','{{%billing_operation}}.sale_id',$uid['id']],
                ['=','assistant_id',$uid['id']],
                ['=','nurse_id',$uid['id']],
                ['=','counselor_id',$uid['id']],
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,

            'surgery_cost' => $this->surgery_cost,

            '{{%billing_operation}}.status' => $this->status,

        ]);
        if(!empty($params['BillingOperation']['created_time'])){
            $query
                ->andFilterWhere(['>=','{{%billing_operation}}.created_time' , $start_time])
                ->andFilterWhere(['<=','{{%billing_operation}}.created_time' , $end_time]);
        }

        $query
            ->andFilterWhere(['like', 'operation_time', $this->operation_time])
            ->andFilterWhere(['like', '{{%customer}}.client_name', $this->client_id])
            ->andFilterWhere(['like', '{{%surgical_items}}.entry_name', $this->surgical_id])
            ->andFilterWhere(['like', '{{%store}}.name', $this->store_id])
        ;


        return $dataProvider;
    }
}
