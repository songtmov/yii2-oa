<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%billing_operation}}".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $surgical_id
 * @property integer $hakim_id
 * @property integer $assistant_id
 * @property integer $nurse_id
 * @property string $surgery_cost
 * @property integer $counselor_id
 * @property integer $store_id
 * @property integer $sale_id
 * @property integer $status
 * @property string $operation_time
 * @property string $created_time
 * @property integer $order_num
 */
class BillingOperation extends \yii\db\ActiveRecord
{
    /**
     * [yearlist 年份列表]
     * @return [type] [description]
     */
    public static function yearlist(){
        $year = [];
        for ($i=1998; $i <= date('Y',time()); $i++) { 
            $year[] = $i;
        }
        return $year;
    }

    /**
     * [mouthlist 月份列表]
     * @return [type] [description]
     */
    public static function mouthlist(){
        $mouth = [];
        for ($i=1; $i <= 12; $i++) {
            $mouth[] = $i;
        }
        return $mouth;
    }

    public static $state = [
        100 => '等待付款',
        168 => '等待手术',
        197 => '手术完成'
    ];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%billing_operation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'surgical_id', 'hakim_id', 'assistant_id', 'nurse_id', 'surgery_cost', 'counselor_id', 'store_id', 'order_num'], 'string','max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'client_id' => Yii::t('common','Client ID'),
            'surgical_id' => Yii::t('common','Surgical ID'),
            'hakim_id' => Yii::t('common','Hakim ID'),
            'assistant_id' => Yii::t('common','Assistant ID'),
            'nurse_id' => Yii::t('common','Nurse ID'),
            'surgery_cost' => Yii::t('common','Surgery Cost'),
            'counselor_id' => Yii::t('common','Counselor ID'),
            'store_id' => Yii::t('common','Store ID'),
            'sale_id' => Yii::t('common','Sale ID'),
            'status' => Yii::t('common','Status'),
            'operation_time' => Yii::t('common','Operation Time'),
            'created_time' => Yii::t('common','Created Time'),
            'cstore_id' => Yii::t('common','Cstore ID'),
            'order_num' => Yii::t('common','订单号'),
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->created_time = time();
            }
            return true;
        }
        else
            return false;
    }
    public function getClient()
    {
        return $this->hasOne(Customer::className(),['id'=>'client_id']);
    }
    public function getSurgical()
    {
        return $this->hasOne(SurgicalItems::className(),['id'=>'surgical_id']);
    }
    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
    public function getAssistant()
    {
        return $this->hasOne(User::className(),['id'=>'assistant_id']);
    }
    public function getNurse()
    {
        return $this->hasOne(User::className(),['id'=>'nurse_id']);
    }
    public function getCounselor()
    {
        return $this->hasOne(User::className(),['id'=>'counselor_id']);
    }
    public function getSale()
    {
        return $this->hasOne(User::className(),['id'=>'sale_id']);
    }
    public function getHakim()
    {
        return $this->hasOne(User::className(),['id'=>'hakim_id']);
    }
    public function getCstore()
    {
        return $this->hasOne(Cstore::className(),['id'=>'cstore_id']);
    }
    /***
     *
     */
    public function getOption()
    {
        $Surgical = SurgicalItems::find()->asArray()->where(['status'=>1])->all();
        $Surgical = \common\category\Category::unlimitedForLayer($Surgical);
        $list = [];
        foreach($Surgical as $value){
            $list[$value['entry_name']]=[];
            if($value['son']!= null ){
                foreach($value['son'] as $item){
                    $list[$value['entry_name']][$item['id']]=$item['entry_name'];
                }
            }
        }
        return $list;
    }
}