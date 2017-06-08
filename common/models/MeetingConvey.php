<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mly_meeting_convey".
 *
 * @property string $id
 * @property integer $meeting_type
 * @property string $meeting_topic
 * @property string $meeting_address
 * @property string $cstore_id
 * @property string $cstore_address
 * @property string $owner_id
 * @property string $owner_phone
 * @property string $cstore_number
 * @property string $cstore_area
 * @property string $manager_id
 * @property string $manager_phone
 * @property string $emplyees_number
 * @property string $training_date
 * @property string $hotel_name
 * @property string $hotel_address
 * @property string $hotel_floor
 * @property string $doctor_id
 * @property string $instructor_id
 * @property string $host_id
 * @property string $asistant_id
 * @property string $consultant_id
 * @property string $engineer_id
 * @property string $nurse_id
 * @property string $resident_id
 * @property string $cameraman_id
 * @property string $travel_arrangement
 * @property string $ticket
 * @property string $draw
 * @property string $invitation
 * @property string $box
 * @property string $vehicle_type
 * @property string $renter_id
 * @property string $marketing_responsible_id
 * @property string $meeting_responsible_id
 * @property string $ko_solution
 * @property string $place_solution
 * @property string $creattime
 * @property string $comment
 */
class MeetingConvey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mly_meeting_convey';
    }

    public static $status = [
        '0' => '小会',
        '1' => '大会'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_type'], 'required'],
            [['meeting_type', 'owner_phone', 'cstore_number', 'cstore_area', 'manager_phone', 'emplyees_number', 'hotel_floor', 'ticket', 'draw', 'invitation', 'box'], 'integer'],
            [['training_date', 'creattime'], 'safe'],
            [['travel_arrangement', 'vehicle_type', 'ko_solution', 'place_solution', 'comment'], 'string'],
            [['meeting_topic', 'meeting_address', 'cstore_id'], 'string', 'max' => 255],
            [['cstore_address'], 'string', 'max' => 90],
            [['owner_id', 'manager_id', 'doctor_id', 'instructor_id', 'host_id', 'asistant_id', 'consultant_id', 'engineer_id', 'nurse_id', 'resident_id', 'cameraman_id', 'renter_id', 'marketing_responsible_id', 'meeting_responsible_id'], 'string', 'max' => 12],
            [['hotel_name'], 'string', 'max' => 45],
            [['hotel_address'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'id' => Yii::t('common','自增ID'),
            'meeting_type' => Yii::t('common','会议类型'),
            'meeting_topic' => Yii::t('common','会议主题'),
            'meeting_address' => Yii::t('common','会议地址'),

            'cstore_id' => Yii::t('common','美容院名称'),

            'cstore_address' => Yii::t('common','美容院地址'),
            'owner_id' => Yii::t('common','老板姓名'),
            'owner_phone' => Yii::t('common','老板手机号码'),
            'cstore_number' => Yii::t('common','店面数量'),
            'cstore_area' => Yii::t('common','店面面积'),
            'manager_id' => Yii::t('common','店长姓名'),
            'manager_phone' => Yii::t('common','店长手机号码'),
            'emplyees_number' => Yii::t('common','员工数量'),
            'training_date' => Yii::t('common','培训时间'),
            'hotel_name' => Yii::t('common','酒店名称'),
            'hotel_address' => Yii::t('common','酒店地址'),
            'hotel_floor' => Yii::t('common','酒店楼层'),

            'doctor_id' => Yii::t('common','医生'),
            'instructor_id' => Yii::t('common','讲师'),
            'host_id' => Yii::t('common','主持人'),
            'asistant_id' => Yii::t('common','医助'),
            'consultant_id' => Yii::t('common','咨询师'),
            'engineer_id' => Yii::t('common','音视频师'),
            'nurse_id' => Yii::t('common','护士'),
            'resident_id' => Yii::t('common','驻店'),
            'cameraman_id' => Yii::t('common','摄像师'),

            'travel_arrangement' => Yii::t('common','行程安排'),
            'ticket' => Yii::t('common','门票'),
            'draw' => Yii::t('common','抽奖卡'),
            'invitation' => Yii::t('common','邀请函'),
            'box' => Yii::t('common','套盒数量'),
            'vehicle_type' => Yii::t('common','车辆种类'),
            'renter_id' => Yii::t('common','租车负责人'),

            'marketing_responsible_id' => Yii::t('common','市场部负责人'),
            'meeting_responsible_id' => Yii::t('common','会务部负责'),

            'ko_solution' => Yii::t('common','秒杀方案'),
            'place_solution' => Yii::t('common','会场方案'),
            'creattime' => Yii::t('common','完成会议传达时间'),
            'comment' => Yii::t('common','备注'),
        ];
    }


     public function getUserModel(){
        return $this->hasOne(UserModel::className(),['id'=>'doctor_id']);
    }

    public function getCstore(){
        return $this->hasOne(CStore::className(),['id'=>'cstore_id']);
    }
}
