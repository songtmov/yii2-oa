<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Photos as PhotosModel;
use common\models\Customer;

/**
 * Photos represents the model behind the search form about `common\models\Photos`.
 */
class Photos extends PhotosModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'billing_id', 'photo_type'], 'integer'],
            [[ 'customer_id','photo_name', 'remark'], 'safe'],
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
        $query = PhotosModel::find();

        // add conditions that should always apply here
       $dataProvider = new ActiveDataProvider([
           'query' => $query,
       ]);

       if(isset($params['Photos']['customer_id'])){
            $res = Customer::find()->select('id')->where(['client_name'=>$params['Photos']['customer_id']])->one();
            if($res){
                $customer_id = $res->id;
            }else{
                $customer_id = $this->customer_id;
            }
        }else{
            $customer_id = $this->customer_id;
        }
        
        // $result = User::find()->where([
        //     'status'=>1,
        //     ])->andwhere([
        //     'or',
        //     ['like','username',$username],
        //     ['like','email',$email],
        //     ['like','mobile',$mobile],
        // ])->all();
        
        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20; //默认20
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>  ['pageSize' => $pageSize,]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            'customer_id' => $customer_id,
            // 'customer_id' => $this->customer_id,
            'photo_type' => $this->photo_type,
        ]);

        $query
            // ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'photo_name', $this->photo_name])
            ->andFilterWhere(['like', 'billing_id', $this->billing_id])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
