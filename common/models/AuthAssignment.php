<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_type}}".
 *
 * @property integer $id
 * @property string $customer_type
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_type'], 'required'],
            [['customer_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增列'),
            'customer_type' => Yii::t('common','顾客分类'),
        ];
    }
}
