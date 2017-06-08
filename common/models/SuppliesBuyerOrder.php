<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%supplies_buyer_order}}".
 *
 * @property string $id
 * @property string $buyer_number
 * @property integer $store_id
 * @property integer $status
 * @property string $applicant_id
 * @property string $buyer_id
 * @property string $created_time
 * @property string $updated_time
 */
class SuppliesBuyerOrder extends \yii\db\ActiveRecord
{
    /**
     * 定义采购单状态
     * [$state description]
     * @var [type]
     */
    public static $state = [
        43=>'等待审核',
        68=>'等待确认',
        98=>'正在采购',
        136=>'采购完成，等待入库',
        200=>'已入库'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%supplies_buyer_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buyer_number', 'store_id', 'status', 'applicant_id'], 'required'],
            [['store_id', 'status', 'applicant_id', 'buyer_id', 'created_time', 'updated_time'], 'integer'],
            [['buyer_number'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'buyer_number' => Yii::t('common','Buyer Number'),
            'store_id' => Yii::t('common','Store ID'),
            'status' => Yii::t('common','Status'),
            'applicant_id' => Yii::t('common','Applicant ID'),
            'buyer_id' => Yii::t('common','Buyer ID'),
            'created_time' => Yii::t('common','Created Time'),
            'updated_time' => Yii::t('common','Updated Time'),
        ];
    }
    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
    public function getApplicant()
    {
        return $this->hasOne(User::className(),['id'=>'applicant_id']);
    }
    public function getBuyer()
    {
        return $this->hasOne(User::className(),['id'=>'buyer_id']);
    }
}
