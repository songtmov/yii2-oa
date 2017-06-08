<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_visit}}".
 *
 * @property string $id
 * @property string $customer_id
 * @property integer $cause
 * @property string $details
 * @property integer $service_id
 * @property integer $to_store_time
 */
class CustomerVisit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_visit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'cause', 'details'], 'required'],
            [['customer_id', 'cause', 'service_id', 'status', 'to_store_time'], 'integer'],
            [['details'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'customer_id' => Yii::t('common','Customer ID'),
            'cause' => Yii::t('common','Cause'),
            'details' => Yii::t('common','Details'),
            'service_id' => Yii::t('common','Service ID'),
            'to_store_time' => Yii::t('common','To Store Time'),
            'status' => Yii::t('common','Status'),
        ];
    }

    /***
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->to_store_time=time();
            }
            return true;
        }
        else
            return false;
    }

    /***
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(),['id'=>'customer_id']);
    }

    /***
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserModel::className(),['id'=>'service_id']);
    }
}
