<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%meetlogin}}".
 *
 * @property string $ml_id
 * @property string $ma_id
 * @property string $ml_logintime
 * @property string $ml_loginresult
 */
class Login extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meetlogin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_id', 'ml_logintime', 'ml_loginresult'], 'required'],
            [['ma_id', 'ml_logintime'], 'integer'],
            [['ml_loginresult'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ml_id' => Yii::t('common','会务处理的自增id'),
            'ma_id' => Yii::t('common','会务申请的id'),
            'ml_logintime' => Yii::t('common','会务处理的时间（无法修改）'),
            'ml_loginresult' => Yii::t('common','1通过 0 不通过 默认无状态'),
        ];
    }
}
