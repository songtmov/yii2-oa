<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $path
 * @property string $language
 * @property integer $grade
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'grade'], 'integer'],
            [['name', 'language','province'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['path'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'parent_id' => Yii::t('common','Parent ID'),
            'name' => Yii::t('common','Name'),
            'path' => Yii::t('common','Path'),
            'language' => Yii::t('common','Language'),
            'grade' => Yii::t('common','Grade'),
        ];
    }
}
