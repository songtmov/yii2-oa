<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%store_follow}}".
 *
 * @property integer $id
 * @property string $content
 * @property string $cooperation
 * @property string $fail_reason
 * @property integer $user_id
 * @property string $backup
 * @property string $sub_time
 * @property string $store_name
 * @property integer $phone
 * @property string $boss
 */
class StoreFollow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store_follow}}';
    }

    public static $cooperation = [
        '0' => '手机',
        '1' => '微信',
        '2' => 'QQ',
        '3' => '短信',
        '4' => '面谈'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'user_id', 'phone', 'boss','cooperation'], 'required'],
            [['content', 'cooperation'], 'string'],
            [['user_id', 'phone'], 'integer'],
            [['sub_time'], 'safe'],
            [['fail_reason', 'backup'], 'string', 'max' => 240],
            [['store_name'], 'string', 'max' => 60],
            [['boss'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','主键ID'),
            'content' => Yii::t('common','详情描述'),
            'cooperation' => Yii::t('common','洽谈方式'),
            'fail_reason' => Yii::t('common','未成交的原因'),
            'user_id' => Yii::t('common','录入人'),
            'backup' => Yii::t('common','备注'),
            'sub_time' => Yii::t('common','录入时间'),
            'store_name' => Yii::t('common','美容院名称'),
            'phone' => Yii::t('common','联系手机'),
            'boss' => Yii::t('common','老板名'),
        ];
    }

    /***
     * 关联用户表
     * @return \yii\db\ActiveQuery
     *
     */
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
