<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%check}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cate_id
 * @property integer $item_id
 * @property integer $paper_num
 * @property integer $actual_num
 * @property string $remark
 * @property integer $deviation
 * @property string $deviation_reason
 */
class Check extends \yii\db\ActiveRecord
{
    public $name = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%check}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_id', 'user_id','paper_num', 'actual_num', 'deviation'], 'integer'],
            [['remark', 'deviation_reason','user_id'], 'required'],
            [['remark', 'item_id','deviation_reason'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增id'),
            'cate_id' => Yii::t('common','物品类别'),
            'item_id' => Yii::t('common','物品名称'),
            'paper_num' => Yii::t('common','账面数量'),
            'actual_num' => Yii::t('common','实际数量'),
            'deviation' => Yii::t('common','盘差'),
            'deviation_reason' => Yii::t('common','盘差原因'),
            'remark' => Yii::t('common','备注'),
            'user_id' => Yii::t('common','录入人'),
            'time' => Yii::t('common','录入时间'),
        ];
    }

    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'cate_id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

}
