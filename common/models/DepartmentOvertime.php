<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%department_overtime}}".
 *
 * @property string $id
 * @property string $application_department
 * @property string $work_reason
 * @property string $full_time
 * @property string $developed_start_time
 * @property string $developed_over_time
 * @property string $actual_start_time
 * @property string $actual_over_time
 * @property string $overtimes
 * @property string $department_opinion
 * @property string $manager_opinion
 */
class DepartmentOvertime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department_overtime}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_department', 'work_reason', 'full_time', 'developed_start_time', 'developed_over_time', 'actual_start_time', 'actual_over_time', 'overtimes', 'department_opinion', 'manager_opinion'], 'required'],
            [['work_reason', 'overtimes', 'department_opinion', 'manager_opinion'], 'string'],
            [['application_department'], 'string', 'max' => 30],
            [['full_time', 'developed_start_time', 'developed_over_time', 'actual_start_time', 'actual_over_time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','部门加班id'),
            'application_department' => Yii::t('common','部门名称'),
            'work_reason' => Yii::t('common','加班原因'),
            'full_time' => Yii::t('common','创建时间'),
            'developed_start_time' => Yii::t('common','拟定开始时间'),
            'developed_over_time' => Yii::t('common','拟定结束时间'),
            'actual_start_time' => Yii::t('common','实际开始时间'),
            'actual_over_time' => Yii::t('common','实际结束时间'),
            'overtimes' => Yii::t('common','加班人员--以，分割'),
            'department_opinion' => Yii::t('common','部门意见'),
            'manager_opinion' => Yii::t('common','总经理意见'),
        ];
    }
}
