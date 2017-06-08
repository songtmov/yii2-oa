<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%supplies_buyer_detail}}".
 *
 * @property string $id
 * @property string $supplie_id
 * @property string $number
 * @property string $order_id
 * @property string $created_time
 */
class SuppliesBuyerDetail extends \yii\db\ActiveRecord
{
    public $cate_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%supplies_buyer_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplie_id', 'cate_id', 'number', 'order_id', 'created_time'], 'required'],
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
            'number' => Yii::t('common','number'),
            'order_id' => Yii::t('common','Order ID'),
            'cate_id' => '耗材分类',
            'created_time' => Yii::t('common','Created Time'),
        ];
    }
    public function getSupplie()
    {
        return $this->hasOne(Supplies::className(),['id'=>'supplie_id']);
    }
    public function getOrder()
    {
        return $this->hasOne(SuppliesBuyerOrder::className(),['id'=>'order_id']);
    }
}
