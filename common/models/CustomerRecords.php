<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_records}}".
 *
 * @property integer $id
 * @property string $pay
 * @property string $visited_problem
 * @property string $after_time
 * @property string $operating_position
 * @property string $visited_time
 * @property integer $visited_id
 * @property string $visited_mode
 * @property string $visited_content
 * @property string $bed_position
 * @property integer $ishealthy
 * @property string $customer_detail
 * @property integer $service_id
 */
class CustomerRecords extends \yii\db\ActiveRecord
{
    public static $static = [
        '0' => '手机电话',
        '1' => '面谈',
        '2' => 'QQ微信',
        '3' => '其他'
    ];

    public static $healthy = [
        '0' => '很好',
        '1' => '一般',
        '2' => '较差'
    ];

    public $store_created_time = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_records}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pay', 'visited_problem', 'after_time', 'operating_position', 'visited_time', 'visited_id', 'visited_mode', 'visited_content', 'ishealthy'], 'required'],
            [['pay'], 'number'],
            [['visited_time'], 'safe'],
            [['visited_id', 'ishealthy', 'service_id'], 'integer'],
            [['visited_mode', 'customer_detail'], 'string'],
            [['visited_problem', 'visited_content', 'bed_position'], 'string', 'max' => 500],
            [['after_time', 'operating_position'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'pay' => Yii::t('common','订单金额'),
            'visited_problem' => Yii::t('common','回访问题'),
            'after_time' => Yii::t('common','术后康复时间'),
            'operating_position' => Yii::t('common','操作部位'),
            'visited_time' => Yii::t('common','回访时间'),
            'visited_id' => Yii::t('common','回访人'),
            'visited_mode' => Yii::t('common','回访方式'),
            'visited_content' => Yii::t('common','回访内容'),
            'bed_position' => Yii::t('common','铺垫内容'),
            'ishealthy' => Yii::t('common','是否健康'),
            'customer_detail' => Yii::t('common','综合描述'),
            'service_id' => Yii::t('common','手术订单'),
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'visited_id']);
    }
}
