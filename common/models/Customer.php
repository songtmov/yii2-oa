<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $client_name
 * @property string $telephone
 * @property string $member_card
 * @property integer $age
 * @property integer $sex
 * @property integer $store_id
 * @property integer $source
 * @property string $remark
 * @property integer $sale_id
 * @property integer $service_id
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $cstore_id
 */
class Customer extends \yii\db\ActiveRecord
{
    public static $static = [
        1 => '新闻媒体',
        2 => '客户转介',
        3 => '市场销售',
        4 => '网络搜索',
        5 => '报纸杂志',
    ];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_name', 'age', 'sex', 'source'], 'required'],
            [['sex', 'store_id', 'source', 'sale_id', 'service_id', 'created_time', 'updated_time', 'cstore_id'], 'integer'],
            [['client_name'], 'string', 'max' => 20],
            [['telephone'], 'string', 'max' => 15],
            [['member_card'], 'string', 'max' => 30],
            [['remark'], 'string', 'max' => 300],
            [['client_name'], 'unique'],
            [['age'],'integer','max'=>99],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'client_name' => Yii::t('common','Client Name'),
            'telephone' => Yii::t('common','Telephone'),
            'member_card' => Yii::t('common','Member Card'),
            'age' => Yii::t('common','Age'),
            'sex' => Yii::t('common','Sex'),
            // 'store_id' => Yii::t('common','Store ID'),
            'source' => Yii::t('common','Source'),
            'remark' => Yii::t('common','Remark'),
            'sale_id' => Yii::t('common','Sale ID'),
            'service_id' => Yii::t('common','咨询师'),
            'created_time' => Yii::t('common','Created Time'),
            'updated_time' => Yii::t('common','Updated Time'),
            'store_id' => Yii::t('common','所属美容院'),
            'cstore_id' => Yii::t('common','所属美容院'),
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->created_time = time();
                $this->updated_time = time();
            }
            else
                $this->updated_time = time();
            return true;
        }
        else
            return false;
    }

    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }

    public function getCstore()
    {
        return $this->hasOne(Cstore::className(),['id'=>'cstore_id']);

    }
    public function getSale()
    {
        return $this->hasOne(UserModel::className(),['id'=>'sale_id']);
    }
    public function getService()
    {
        return $this->hasOne(UserModel::className(),['id'=>'service_id']);
    }
}
