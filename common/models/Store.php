<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mly_store".
 *
 * @property integer $id
 * @property string $name
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property string $address
 * @property string $Store_image
 * @property integer $acreage
 * @property integer $head_id
 * @property string $contact_number
 * @property integer $store_created_time
 * @property integer $created_time
 * @property integer $updated_time
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'province', 'city', 'area', 'address', 'Store_image', 'acreage', 'head_id', 'contact_number', 'store_created_time'], 'required'],
            [['province', 'city', 'area', 'acreage', 'head_id', 'store_created_time', 'created_time', 'updated_time'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 300],
            [['Store_image'], 'string', 'max' => 150],
            [['contact_number'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'name' => Yii::t('common','Name'),
            'province' => Yii::t('common','Province'),
            'city' => Yii::t('common','City'),
            'area' => Yii::t('common','Area'),
            'address' => Yii::t('common','Address'),
            'Store_image' => Yii::t('common','Store Image'),
            'acreage' => Yii::t('common','医院面积'),
            'head_id' => Yii::t('common','Head ID'),
            'contact_number' => Yii::t('common','医院电话'),
            'store_created_time' => Yii::t('common','Store Created Time'),
            'created_time' => Yii::t('common','Created Time'),
            'updated_time' => Yii::t('common','Updated Time'),
        ];
    }
    
    public function beforeSave($insert){
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->created_time=time();
                $this->updated_time=time();
            }
            else
                $this->updated_time=time();
            return true;
        }
        else
            return false;
    }
    /***
     * 关联用户表
     * @return \yii\db\ActiveQuery
     *
     */
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'head_id']);
    }
    /***
     *
     */
    public function getRegion(){
        return $this->hasOne(Region::className(),['id'=>'city']);
    }
}
