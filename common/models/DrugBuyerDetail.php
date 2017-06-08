<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mly_drug_buyer_detail".
 *
 * @property string $id
 * @property string $leechdom_id
 * @property string $number
 * @property string $order_id
 * @property string $created_time
 */
class DrugBuyerDetail extends \yii\db\ActiveRecord
{
    public $cate_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mly_drug_buyer_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leechdom_id', 'number', 'order_id','cate_id'], 'required'],
            [['leechdom_id', 'number', 'order_id', 'created_time'], 'integer'],
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
            'cate_id' => '药品分类',
            'order_id' => Yii::t('common','Order ID'),
            'created_time' => Yii::t('common','Created Time'),
        ];
    }
    public function getLeechdom()
    {
        return $this->hasOne(Leechdom::className(),['id'=>'leechdom_id']);
    }
    public function getOrder()
    {
        return $this->hasOne(DrugBuyerOrder::className(),['id'=>'order_id']);
    }
}
