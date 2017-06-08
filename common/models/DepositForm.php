<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%deposit_form}}".
 *
 * @property integer $id
 * @property integer $billing_id
 * @property string $deposit
 * @property string $payment_method
 * @property integer $user_id
 * @property string $nbackup
 * @property string $sub_time
 */
class DepositForm extends \yii\db\ActiveRecord
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
        return '{{%deposit_form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['billing_id', 'deposit', 'user_id', 'sub_time'], 'required'],
            [['billing_id', 'user_id'], 'integer'],
            [['deposit'], 'number'],
            [['payment_method', 'nbackup'], 'string'],
            [['sub_time'], 'safe'],
            [['billing_id'], 'unique','message'=>'{attribute}已交过定金！']
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
            'deposit' => Yii::t('common','定金金额'),
            'payment_method' => Yii::t('common','收款方式'),
            'user_id' => Yii::t('common','收款人'),
            'nbackup' => Yii::t('common','备注'),
            'sub_time' => Yii::t('common','收款时间'),
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
