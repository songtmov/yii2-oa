<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%record_nursing}}".
 *
 * @property integer $id
 * @property string $customer_profiles_id
 * @property string $customer_id
 * @property string $record_date
 * @property string $record_time
 * @property string $body_tempreture
 * @property string $blood_pressure
 * @property string $pulse
 * @property string $heart_rate
 * @property string $nurse_id
 * @property string $create_time
 */
class RecordNursing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%record_nursing}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_profiles_id', 'customer_id', 'record_date', 'record_time'], 'required'],
            [['customer_profiles_id', 'customer_id', 'nurse_id'], 'integer'],
            [['record_date', 'record_time', 'create_time'], 'safe'],
            [['body_tempreture', 'blood_pressure', 'pulse'], 'string', 'max' => 20],
            [['record_time'], 'string', 'max' => 50],
            [['heart_rate'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增列'),
            'customer_profiles_id' => Yii::t('common','手术档案号'),
            'customer_id' => Yii::t('common','顾客名称'),
            'record_date' => Yii::t('common','护理日期'),
            'record_time' => Yii::t('common','护理时间'),
            'body_tempreture' => Yii::t('common','体温'),
            'blood_pressure' => Yii::t('common','血压'),
            'pulse' => Yii::t('common','脉膊'),
            'heart_rate' => Yii::t('common','呼吸'),
            'nurse_id' => Yii::t('common','护士'),
            'create_time' => Yii::t('common','创建时间'),
        ];
    }

    public function getUser()
    {
       return $this->hasOne(User::className(),['id'=>'nurse_id']);
    }
    
    public function getCustomer()
    {
       return $this->hasOne(Customer::className(),['id'=>'customer_id']);
    }
}
