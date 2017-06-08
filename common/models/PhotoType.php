<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%photo_type}}".
 *
 * @property string $id
 * @property string $name
 */
class PhotoType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','类型的自增id'),
            'name' => Yii::t('common','类型名称'),
        ];
    }
}
