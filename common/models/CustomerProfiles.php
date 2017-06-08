<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_profiles}}".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $billing_id
 * @property string $surger_date
 * @property string $starting_time
 * @property string $finishing_time
 * @property string $dignosis_before
 * @property string $type_of_anesthesia
 * @property string $anesesiologistID
 * @property integer $is_clear
 * @property integer $change_clothes
 * @property integer $skin_preparation
 * @property integer $remove_jewelry
 * @property integer $pathway
 * @property string $medicine_name
 * @property string $medicine_specification
 * @property string $transfusion_time
 * @property string $nuresID
 * @property integer $hepatitis_B
 * @property integer $hepatitis_C
 * @property integer $AIDS
 * @property integer $syphilis
 * @property integer $blood_sugar
 * @property string $create_time
 */
class CustomerProfiles extends \yii\db\ActiveRecord
{
    public static $yn = [
        '0' => '是',
        '1' => '否'
    ];

    public static $bring = [
        '0' => '正常',
        '1' => '携带者'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_profiles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'billing_id', 'dignosis_before', 'anesesiologistID', 'remove_jewelry', 'medicine_name', 'nuresID', 'hepatitis_B', 'hepatitis_C', 'AIDS', 'syphilis', 'blood_sugar', 'create_time'], 'required'],
            [['customer_id', 'is_clear', 'change_clothes', 'skin_preparation', 'remove_jewelry', 'pathway', 'hepatitis_B', 'hepatitis_C', 'AIDS', 'syphilis', ], 'integer'],
            [['blood_sugar'],'string','max'=>10],
            [['nuresID'],'string','max'=>10],
            [['surger_date', 'starting_time', 'finishing_time', 'transfusion_time', 'create_time'], 'safe'],
            [['type_of_anesthesia'], 'string'],
            [['billing_id'], 'string', 'max' => 40],
            [['dignosis_before'], 'string', 'max' => 500],
            [['anesesiologistID', 'medicine_name', 'medicine_specification'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增列'),
            'customer_id' => Yii::t('common','顾客名'),
            'billing_id' => Yii::t('common','手术订单'),
            'surger_date' => Yii::t('common','手术日期'),
            'starting_time' => Yii::t('common','手术开始日期'),
            'finishing_time' => Yii::t('common','手术结束日期'),
            'dignosis_before' => Yii::t('common','术前诊断'),
            'type_of_anesthesia' => Yii::t('common','麻醉方式'),
            'anesesiologistID' => Yii::t('common','全麻医生 '),
            'is_clear' => Yii::t('common','术后意识状态是否清醒'),
            'change_clothes' => Yii::t('common','是否更换衣服'),
            'skin_preparation' => Yii::t('common','是否备皮'),
            'remove_jewelry' => Yii::t('common','是否去除饰品'),
            'pathway' => Yii::t('common','是否建立静脉通道'),
            'medicine_name' => Yii::t('common','输液药品名称及药品规格'),
            'medicine_specification' => Yii::t('common','输液药品规格'),
            'transfusion_time' => Yii::t('common','输液时间'),
            'nuresID' => Yii::t('common','护士'), 
            'hepatitis_B' => Yii::t('common','乙肝'),
            'hepatitis_C' => Yii::t('common','丙肝'),
            'AIDS' => Yii::t('common','艾滋'),
            'syphilis' => Yii::t('common','梅毒 '),
            'blood_sugar' => Yii::t('common','血糖'),
            'create_time' => Yii::t('common','护理日期'),
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(),['id'=>'customer_id']);
    }

     public function getUser()
    {
        return $this->hasOne(UserModel::className(),['id'=>'anesesiologistID']);
    }
}
