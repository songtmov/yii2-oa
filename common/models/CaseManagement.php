<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%case_management}}".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $path
 * @property string $nbackup
 * @property string $submit_time
 */
class CaseManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%case_management}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'path'], 'required'],
            [['customer_id'], 'integer'],
            [['nbackup'], 'string'],
            [['submit_time'], 'safe'],
            [['path'], 'string', 'max' => 50],
            [['customer_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增id'),
            'customer_id' => Yii::t('common','客户名称'),
            'path' => Yii::t('common',''),
            'nbackup' => Yii::t('common','备注'),
            'submit_time' => Yii::t('common','创建时间'),
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(),['id'=>'customer_id']);
    }
}
