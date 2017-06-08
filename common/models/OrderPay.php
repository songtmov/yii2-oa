<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order_pay}}".
 *
 * @property integer $id
 * @property integer $billing_id
 * @property integer $isall
 * @property string $sum_money
 * @property integer $user_id
 * @property string $nbackup
 * @property string $sub_time
 * @property string $payment_method
 */
class OrderPay extends \yii\db\ActiveRecord
{
    public static $static = [
        '0' => '现金',
        '1' => '刷卡',
        '2' => '转账'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_pay}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['billing_id', 'isall', 'sum_money', 'user_id', 'sub_time','payment_method'], 'required'],
            [['billing_id', 'isall', 'user_id'], 'integer'],
            [['sum_money'], 'number'],
            [['nbackup', 'payment_method'], 'string'],
            [['sub_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增ID'),
            'billing_id' => Yii::t('common','手术订单'),
            'isall' => Yii::t('common','是否全款'),
            'sum_money' => Yii::t('common','实收金额'),
            'user_id' => Yii::t('common','收款人ID'),
            'nbackup' => Yii::t('common','备注'),
            'sub_time' => Yii::t('common','收款时间'),
            'payment_method' => Yii::t('common','收款方式'),
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
