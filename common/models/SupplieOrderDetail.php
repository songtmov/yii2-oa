<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%supplie_order_detail}}".
 *
 * @property integer $id
 * @property integer $supplie_id
 * @property integer $number
 * @property integer $order_id
 * @property integer $created_time
 */
class SupplieOrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%supplie_order_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplie_id', 'number', 'order_id', 'created_time'], 'required'],
            [['supplie_id', 'number', 'order_id', 'created_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'supplie_id' => Yii::t('common','Supplie ID'),
            'number' => '数量',
            'order_id' => Yii::t('common','Order ID'),
            'created_time' => Yii::t('common','Created Time'),
        ];
    }
    public function getSupplie()
    {
        return $this->hasOne(Supplies::className(),['id'=>'supplie_id']);
    }
}
