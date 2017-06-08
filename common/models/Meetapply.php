<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%meetapply}}".
 *
 * @property string $ma_id
 * @property string $ma_content
 * @property string $ma_meetname
 * @property integer $ma_countpeople
 * @property string $ma_department
 * @property string $ma_starttime
 * @property string $ma_endtime
 * @property string $ma_speaker
 * @property string $ma_createtime
 * @property string $ma_type
 * @property string $ma_meetaddress
 * @property string $ma_remark
 * @property string $ma_uid
 * @property integer $ma_delete
 */
class Meetapply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meetapply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_content', 'ma_meetname', 'ma_countpeople', 'ma_department', 'ma_starttime', 'ma_endtime', 'ma_speaker'], 'required'],
            [['ma_content', 'ma_type', 'ma_remark'], 'string'],
            [['ma_countpeople', 'ma_createtime', 'ma_uid', 'ma_delete'], 'integer'],
            [['ma_meetname', 'ma_department', 'ma_speaker', 'ma_meetaddress'], 'string', 'max' => 60],
            [['ma_starttime', 'ma_endtime'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ma_id' => Yii::t('common','ID'),
            'ma_content' => Yii::t('common','会议内容'),
            'ma_meetname' => Yii::t('common','会议名'),
            'ma_countpeople' => Yii::t('common','会议人数'),
            'ma_department' => Yii::t('common','参与部门'),
            'ma_starttime' => Yii::t('common','会议开始'),
            'ma_endtime' => Yii::t('common','会议结束'),
            'ma_speaker' => Yii::t('common','讲师'),
            'ma_createtime' => Yii::t('common','创建时间'),
            'ma_type' => Yii::t('common','会议类型'),
            'ma_meetaddress' => Yii::t('common','会议地址'),
            'ma_remark' => Yii::t('common','会议备注'),
            'ma_uid' => Yii::t('common','发起人'),
            'ma_delete' => Yii::t('common','删除状态'),
        ];
    }
}
