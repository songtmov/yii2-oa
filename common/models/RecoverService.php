<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%recover_service}}".
 *
 * @property integer $id
 * @property string $most_satisfied
 * @property string $not_most_satisfied
 * @property integer $billing_id
 * @property string $description
 */
class RecoverService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recover_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['most_satisfied', 'grade','not_most_satisfied', 'billing_id'], 'required'],
            [['most_satisfied', 'not_most_satisfied', 'description'], 'string'],
            [['billing_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'most_satisfied' => Yii::t('common','最满意部位'),
            'not_most_satisfied' => Yii::t('common','最不满意部位'),
            'billing_id' => Yii::t('common','手术订单号'),
            'description' => Yii::t('common','详细描述'),
            'grade' => Yii::t('common','手术评星'),
        ];
    }
}
