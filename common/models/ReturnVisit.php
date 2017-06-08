<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mly_return_visit".
 *
 * @property integer $id
 * @property string $visit_id
 * @property string $client_id
 * @property integer $client_status
 * @property integer $mode
 * @property integer $is_satisfied
 * @property integer $health
 * @property string $visit_content
 * @property string $response
 * @property integer $re_id
 * @property integer $status
 * @property integer $created_time
 * @property integer $updated_time
 */
class ReturnVisit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mly_return_visit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'client_status', 'mode', 'is_satisfied', 'health', 'visit_content', 'response'], 'required'],
            [['visit_id', 'client_id', 'client_status', 'mode', 'is_satisfied', 'health', 're_id', 'status', 'created_time', 'updated_time'], 'integer'],
            [['visit_content', 'response'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'visit_id' => Yii::t('common','Visit ID'),
            'client_id' => Yii::t('common','Client ID'),
            'client_status' => Yii::t('common','Client Status'),
            'mode' => Yii::t('common','Mode'),
            'is_satisfied' => Yii::t('common','Is Satisfied'),
            'health' => Yii::t('common','Health'),
            'visit_content' => Yii::t('common','Visit Content'),
            'response' => Yii::t('common','Response'),
            're_id' => Yii::t('common','Re ID'),
            'status' => Yii::t('common','Status'),
            'created_time' => Yii::t('common','Created Time'),
            'updated_time' => Yii::t('common','Updated Time'),
        ];
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->created_time = time();
                $this->updated_time = time();
            }
            else
                $this->updated_time = time();
            return true;
        }
        else
            return false;
    }
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(),['id'=>'client_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'re_id']);
    }
}
