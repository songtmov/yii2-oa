<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%meetlogin}}".
 * @property string $ml_id
 * @property string $ma_id
 * @property string $ml_logintime
 * @property string $ml_uid
 * @property string $ml_type
 */
class Meetlogin extends \yii\db\ActiveRecord
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
            [['ma_id', 'ml_logintime', 'ml_uid'], 'required'],
            [['ma_id', 'ml_logintime', 'ml_uid'], 'integer'],
            [['ml_type'], 'string'],
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
            'ml_logintime' => Yii::t('common','会务处理的时间'),
            'ml_uid' => Yii::t('common','操作人'),
            'ml_type' => Yii::t('common','操作类型 0查看--1审核--2删除'),
        ];
    }

    public function getUser()
    {
        $connection = yii::$app->db;
        $sql = "SELECT * FROM (mly_meetlogin LEFT JOIN mly_user ON mly_meetlogin.ml_uid=mly_user.id) left join mly_meetapply on mly_meetlogin.ma_id=mly_meetapply.ma_id";
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }
}