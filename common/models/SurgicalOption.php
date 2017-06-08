<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%surgical_option}}".
 *
 * @property integer $id
 * @property string $option_name
 */
class SurgicalOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%surgical_option}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'option_name' => Yii::t('common','方式名'),
        ];
    }
}
