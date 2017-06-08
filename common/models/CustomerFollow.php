<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_follow}}".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $follow_mode
 * @property string $details
 * @property string $fail_resource
 * @property integer $user_id
 * @property string $sub_time
 */
class CustomerFollow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_follow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'details', 'fail_resource', 'user_id', 'sub_time'], 'required'],
            [['customer_id', 'user_id'], 'integer'],
            [['follow_mode', 'details'], 'string'],
            [['sub_time'], 'safe'],
            [['fail_resource'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增列'),
            'customer_id' => Yii::t('common','顾客'),
            'follow_mode' => Yii::t('common','联系方式'),
            'details' => Yii::t('common','跟进详情'),
            'fail_resource' => Yii::t('common','失败的原因'),
            'user_id' => Yii::t('common','录入人'),
            'sub_time' => Yii::t('common','时间'),
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(),['id'=>'customer_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
