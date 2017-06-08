<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%outbound_order}}".
 *
 * @property integer $id
 * @property integer $billing_id
 * @property string $item_id
 * @property integer $cate_id
 * @property integer $numbers
 * @property string $nbackup
 * @property string $submit_time
 */
class OutboundOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%outbound_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['billing_id', 'cate_id', 'numbers'], 'integer'],
            [['item_id', 'cate_id', 'numbers'], 'required'],
            [['nbackup'], 'string'],
            [['submit_time'], 'safe'],
            [['item_id'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增id'),
            'billing_id' => Yii::t('common','手术订单'),
            'item_id' => Yii::t('common','物品ID与名称'),
            'cate_id' => Yii::t('common','类别选择'),
            'numbers' => Yii::t('common','出库数量'),
            'nbackup' => Yii::t('common','备注'),
            'submit_time' => Yii::t('common','出库时间'),
        ];
    }
}
