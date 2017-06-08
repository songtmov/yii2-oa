<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%drug_order}}".
 *
 * @property string $id
 * @property string $bill_id
 * @property string $client_id
 * @property string $order_number
 * @property string $amount
 * @property string $store_id
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 */
class DrugOrder extends \yii\db\ActiveRecord
{
    
    public static $state=[
        100 => '等待付款',
        168 => '等待发放',
        198 => '已经发放'
    ];
 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%drug_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bill_id', 'client_id', 'store_id'], 'required'],
            [['bill_id', 'client_id', 'store_id', 'status', 'created_time', 'updated_time'], 'integer'],
            [['amount'], 'number'],
            [['order_number'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'bill_id' => Yii::t('common','Bill ID'),
            'client_id' => Yii::t('common','Client ID'),
            'order_number' => Yii::t('common','Order number'),
            'amount' => Yii::t('common','Amount'),
            'store_id' => Yii::t('common','Store ID'),
            'status' => Yii::t('common','Status'),
            'created_time' => Yii::t('common','Created Time'),
            'updated_time' => Yii::t('common','Updated Time'),
            'hakim_id' => '开单医师',
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
    public function getDetail()
    {
        return $this->hasMany(DrugOrderDetail::className(),['id'=>'order_id']);
    }

    public function getClient()
    {
        return $this->hasOne(Customer::className(),['id'=>'client_id']);
    }
    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
    public function getHakim()
    {
        return $this->hasOne(User::className(),['id'=>'hakim_id']);
    }
}
