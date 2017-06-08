<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserModel as UserModelModel;

/**
 * UserModel represents the model behind the search form about `common\models\UserModel`.
 */
class UserModel extends UserModelModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'login_time', 'created_at', 'updated_at'], 'integer'],
            [['username', 'store_id', 'department_id', 'position_id', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'telphone', 'login_ip'], 'safe'],
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
        if(isset($_GET['id'])){

            $query = UserModelModel::find()->where(['{{%user}}.department_id'=>$_GET['id']]);

        }else{

            $query = UserModelModel::find();

        }

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
        $query->joinWith('store');
        $query->joinWith('position');
        $query->joinWith('department');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'login_time' => $this->login_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', '{{%store}}.name', $this->store_id])
            ->andFilterWhere(['like', '{{%position}}.name', $this->position_id])
            ->andFilterWhere(['like', '{{%department}}.name', $this->department_id])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'login_ip', $this->login_ip]);

        return $dataProvider;
    }
}
