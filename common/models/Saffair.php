<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%saffair}}".
 *
 * @property integer $id
 * @property string $customer
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $hospital
 * @property integer $appointment
 * @property integer $appointment_type
 * @property integer $doctor
 * @property string $remark
 */
class Saffair extends \yii\db\ActiveRecord
{
    public $store_created_time = null;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%saffair}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer', 'province', 'city', 'area', 'hospital', 'appointment', 'doctor'], 'required'],
            [['appointment_type', 'doctor'], 'integer'],
            [['remark'], 'string'],
            [['customer', 'province', 'city', 'area', 'hospital'], 'string', 'max' => 18],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'customer' => Yii::t('common','客户'),
            'province' => Yii::t('common','省份'),
            'city' => Yii::t('common','城市'),
            'area' => Yii::t('common','部门'),
            'hospital' => Yii::t('common','医院'),
            'appointment' => Yii::t('common','预约时间'),
            'appointment_type' => Yii::t('common','预约类型'),
            'doctor' => Yii::t('common','医生'),
            'remark' => Yii::t('common','备注'),
        ];
    }
}
