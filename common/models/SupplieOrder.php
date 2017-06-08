<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%supplie_order}}".
 *
 * @property integer $id
 * @property integer $bill_id
 * @property integer $client_id
 * @property string $order_number
 * @property integer $store_id
 * @property integer $hakim_id
 * @property integer $status
 * @property integer $created_time
 * @property integer $updated_time
 */
class SupplieOrder extends \yii\db\ActiveRecord
{
    public static $state = [
        8 => '待付款',
        20 => '已付款',
        30 => '已发放',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%supplie_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'bill_id', 'client_id', 'order_number', 'store_id', 'hakim_id', 'status'], 'required'],
            [[ 'bill_id', 'client_id', 'store_id', 'hakim_id', 'status', 'created_time', 'updated_time'], 'integer'],
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
            'order_number' => Yii::t('common','Order Number'),
            'store_id' => Yii::t('common','Store ID'),
            'hakim_id' => Yii::t('common','Hakim ID'),
            'status' => Yii::t('common','Status'),
            'created_time' => Yii::t('common','Created Time'),
            'updated_time' => Yii::t('common','Updated Time'),
        ];
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
