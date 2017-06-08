<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%overtime}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $fill_time
 * @property string $work_time
 * @property string $work_address
 * @property string $work_reason
 * @property string $executive_opinion
 * @property string $department_opinion
 * @property string $manager_opinion
 */
class Overtime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%overtime}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fill_time', 'work_time', 'work_address', 'work_reason'], 'required'],
            [['user_id', 'fill_time'], 'integer'],
            [['work_reason', 'executive_opinion', 'department_opinion', 'manager_opinion'], 'string'],
            [['work_time'], 'string', 'max' => 41],
            [['work_address'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','加班ID'),
            'user_id' => Yii::t('common','用户'),
            'fill_time' => Yii::t('common','创建时间'),
            'work_time' => Yii::t('common','加班时间'),
            'work_address' => Yii::t('common','加班位置'),
            'work_reason' => Yii::t('common','加班原因'),
            'executive_opinion' => Yii::t('common','主管建议'),
            'department_opinion' => Yii::t('common','部门意见'),
            'manager_opinion' => Yii::t('common','经理意见'),
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
