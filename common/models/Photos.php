<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%photos}}".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $billing_id
 * @property string $path
 * @property string $photo_name
 * @property integer $photo_type
 * @property string $remark
 */

class Photos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'billing_id', 'photo_name', 'photo_type'], 'required'],
            [['customer_id', 'billing_id', 'photo_type'], 'integer'],
            [['photo_name'], 'string', 'max' => 45],
            [['remark'], 'string', 'max' => 150],
            [['path'],'file','extensions'=>'jpeg,jpg,png,gif','maxSize'=>1024*1024*2,'message'=>'图片不要超过2MB'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','相册id'),
            'customer_id' => Yii::t('common','客户名'),
            'billing_id' => Yii::t('common','手术订单'),
            'path' => Yii::t('common','图片'),
            'photo_name' => Yii::t('common','图片事项名'),
            'photo_type' => Yii::t('common','该组图片类型'),
            'remark' => Yii::t('common','标记'),
        ];
    }

    public function getCustomer(){
        return $this->hasOne(Customer::className(),['id' => 'customer_id']);
    }

    public function getPhotoType(){
        return $this->hasOne(PhotoType::className(),['id' => 'photo_type']);
    }
}
