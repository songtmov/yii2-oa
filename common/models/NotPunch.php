<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%not_punch}}".
 *
 * @property string $id
 * @property string $full_time
 * @property string $user_id
 * @property string $not_punch_time
 * @property integer $not_punch_interval
 * @property string $not_punch_reason
 * @property string $depart_opinion
 * @property string $manager_opinion
 */
class NotPunch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%not_punch}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['not_punch_time'], 'safe'],
            [['user_id', 'not_punch_time', 'not_punch_reason'], 'required'],
            [['user_id', 'not_punch_interval'], 'integer'],
            // [['not_punch_reason', 'depart_opinion', 'manager_opinion'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','员工未打卡管理ID'),
            'full_time' => Yii::t('common','创建时间'),
            'user_id' => Yii::t('common','用户名'),
            'not_punch_time' => Yii::t('common','未打卡日期'),
            'not_punch_interval' => Yii::t('common','未打卡类型'),
            'not_punch_reason' => Yii::t('common','未打卡原因'),
            'depart_opinion' => Yii::t('common','部门审批'),
            'manager_opinion' => Yii::t('common','总经理意见'),
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
