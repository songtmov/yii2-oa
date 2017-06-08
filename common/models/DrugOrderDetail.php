<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%drug_order_detail}}".
 *
 * @property string $id
 * @property string $leechdom_id
 * @property integer $number
 * @property string $price
 * @property string $order_id
 * @property string $created_time
 */
class DrugOrderDetail extends \yii\db\ActiveRecord
{
    public $cate_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%drug_order_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leechdom_id', 'number', 'price', 'order_id','cate_id'], 'required'],
            [['leechdom_id', 'number', 'order_id', 'created_time'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'leechdom_id' => Yii::t('common','Leechdom ID'),
            'number' => Yii::t('common','number'),
            'price' => Yii::t('common','Price'),
            'cate_id' => '药品分类',
            'order_id' => Yii::t('common','Order ID'),
            'created_time' => Yii::t('common','Created Time'),
        ];
    }
    public function getOrder()
    {
        return $this->hasOne(DrugOrder::className(),['id'=>'Order_id']);
    }
    
    public function getLeechdom()
    {
        return $this->hasOne(Leechdom::className(),['id'=>'leechdom_id']);
    }

}
