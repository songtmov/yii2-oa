<?php

namespace backend\models;

use common\models\cstore;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cstore as CstoreModel;

/**
 * Customer represents the model behind the search form about `common\models\Customer`.
 */
class StoreSearch extends CstoreModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // ['telephone', 'filter', 'filter' => 'trim'],
            ['store_name', 'required'],
            // ['telephone', 'unique', 'targetClass' => '\common\models\User', 'message' => '该手机号码已经被注册了。'],
            // ['telephone', 'string', 'min' => 11, 'max' => 11],
            // [['telephone'],'match','pattern'=>'^1(3[0-9]|4[57]|5[0-35-9]|7[01678]|8[0-9])\\d{8}$^','message'=>'手机号码格式错误。'],
        ];
    }

    public function search($params)
    {
        $query = cstore::find()->asArray()->where(['store_name'=>$params]);
        return $query;
    }

}
