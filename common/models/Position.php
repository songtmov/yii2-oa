<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mly_position".
 *
 * @property integer $id
 * @property integer $department_id
 * @property string $name
 * @property integer $status
 * @property integer $found_time
 */
class Position extends \yii\db\ActiveRecord
{
    // public static $username = '未设置';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mly_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'name', 'status', 'found_time'], 'required'],
            [['department_id', 'status', 'found_time'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'department_id' => Yii::t('common','Department ID'),
            'name' => Yii::t('common','Name'),
            'status' => Yii::t('common','Status'),
            'found_time' => Yii::t('common','Found Time'),
        ];
    }

    public function getDepartment()
    {
       return $this->hasOne(Department::className(),['id'=>'department_id']);
    }

    
}
