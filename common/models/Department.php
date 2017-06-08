<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%department}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $found_time
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'found_time'], 'required'],
            [['status', 'found_time'], 'integer'],
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
            'name' => Yii::t('common','Name'),
            'status' => Yii::t('common','Status'),
            'found_time' => Yii::t('common','Found Time'),
        ];
    }
}
