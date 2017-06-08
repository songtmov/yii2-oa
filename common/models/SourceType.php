<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%source_type}}".
 *
 * @property integer $id
 * @property string $source_name
 */
class SourceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%source_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_name'], 'required'],
            [['source_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增ID'),
            'source_name' => Yii::t('common','渠道名称'),
        ];
    }
}
