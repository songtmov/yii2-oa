<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%rest}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $rest_start_time
 * @property string $rest_over_time
 * @property string $full_time
 * @property string $department_opinion
 * @property string $d_o_time
 * @property string $manager_opinion
 * @property string $m_o_time
 */
class Rest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rest}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','full_time','rest_start_time','rest_over_time'], 'required'],
            [['user_id','full_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','调休id'),
            'user_id' => Yii::t('common','用户'),
            'rest_start_time' => Yii::t('common','调休开始时间'),
            'rest_over_time' => Yii::t('common','调休结束时间'),
            'full_time' => Yii::t('common','填写时间'),
            'department_opinion' => Yii::t('common','部门负责人意见'),
            'd_o_time' => Yii::t('common','部门负责人意见自动生成时间'),
            'manager_opinion' => Yii::t('common','总经理意见'),
            'm_o_time' => Yii::t('common','总经理意见自动生成时间'),
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
