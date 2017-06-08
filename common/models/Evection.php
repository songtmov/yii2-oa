<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%evection}}".
 *
 * @property string $id
 * @property string $province
 * @property string $city
 * @property string $user_id
 * @property string $store_id
 * @property string $evection_time
 * @property string $evection_reason
 * @property string $evection_info
 * @property string $evection_img
 * @property string $created_time
 * @property string $updated_time
 */
class Evection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%evection}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province', 'city', 'user_id', 'store_id', 'evection_time', 'evection_reason', 'evection_info', 'evection_img'], 'required'],
            [['province', 'city', 'user_id', 'store_id', 'created_time', 'updated_time'], 'integer'],
            [['evection_reason'], 'string', 'max' => 150],
            [['evection_info'], 'string', 'max' => 255],
            [['evection_img'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'province' => Yii::t('common','Province'),
            'city' => Yii::t('common','City'),
            'user_id' => '出差人',
            'store_id' => Yii::t('common','Store ID'),
            'evection_time' => Yii::t('common','Evection Time'),
            'evection_reason' => Yii::t('common','Evection Reason'),
            'evection_info' => Yii::t('common','Evection Info'),
            'evection_img' => Yii::t('common','Evection Img'),
            'created_time' => Yii::t('common','Created Time'),
            'updated_time' => Yii::t('common','Updated Time'),
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

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
}
