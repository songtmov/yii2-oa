<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%c_store}}".
 *
 * @property string $id
 * @property string $store_name
 * @property string $adress
 * @property string $hospital
 * @property string $create_time
 * @property string $telephone
 * @property integer $acreage
 * @property string $store_photo
 * @property string $boss
 * @property string $boss_photo
 * @property string $encamp
 * @property string $consultation
 * @property string $business
 */
class CStore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%c_store}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_name', 'adress', 'hospital','telephone' , 'acreage', 'boss', 'encamp', 'consultation', 'business'], 'required'],
            [['telephone', 'acreage'], 'integer'],
            [['store_name'], 'string', 'max' => 30],
            [['adress'], 'string', 'max' => 75],
            [['hospital'], 'string', 'max' => 60],
            [['create_time'], 'string', 'max' => 20],
            [['boss', 'encamp', 'consultation', 'business'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增id'),
            'store_name' => Yii::t('common','店家名称'),
            'adress' => Yii::t('common','详细地址'),
            'hospital' => Yii::t('common','所属医院'),
            'create_time' => Yii::t('common','创建时间'),
            'telephone' => Yii::t('common','电话'),
            'acreage' => Yii::t('common','面积'),
            // 'store_photo' => Yii::t('common','店家形象照片'),
            'boss' => Yii::t('common','老板姓名'),
            // 'boss_photo' => Yii::t('common','老板个人照片'),
            'encamp' => Yii::t('common','驻店'),
            'consultation' => Yii::t('common','咨询'),
            'business' => Yii::t('common','业务'),
        ];
    }

    public function getUserModel(){
         return $this->hasOne(UserModel::className(),['id'=>'business']);
    }
}
