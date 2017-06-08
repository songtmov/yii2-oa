<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $telphone
 * @property integer $store_id
 * @property integer $department_id
 * @property integer $position_id
 * @property integer $status
 * @property integer $login_time
 * @property string $login_ip
 * @property integer $created_at
 * @property integer $updated_at
 */

class UserModel extends \yii\db\ActiveRecord
{

    public $repassword_hash;
    public $ma_id;
    public $name = null;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash','repassword_hash', 'email', 'telphone', 'store_id', 'department_id', 'position_id'], 'required'],
            [['store_id', 'department_id', 'position_id', 'status', 'login_time', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['telphone'], 'string', 'max' => 15],
            [['login_ip'], 'string', 'max' => 20],
            // [['username'], 'unique'],
            [['email','username'], 'unique'],
            [['password_hash'], 'required'],
            [['password_hash','repassword_hash'], 'string', 'min' => 6, 'max' => 70],
            [['username'], 'string', 'min' => 2, 'max' => 10],
            ['repassword_hash','compare','compareAttribute'=>'password_hash','message'=>'两次密码输入不一致。'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'username' => Yii::t('common','Username'),
            'auth_key' => Yii::t('common','Auth Key'),
            'password_hash' => Yii::t('common','Password Hash'),
            'repassword_hash' => Yii::t('common','Repassword Hash'),
            'password_reset_token' => Yii::t('common','Password Reset Token'),
            'email' => Yii::t('common','Email'),
            'telphone' => Yii::t('common','Telphone'),
            'store_id' => Yii::t('common','Store ID'),
            'department_id' => Yii::t('common','Department ID'),
            'position_id' => Yii::t('common','Position ID'),
            'status' => Yii::t('common','Status'),
            'login_time' => Yii::t('common','Login Time'),
            'login_ip' => Yii::t('common','Login Ip'),
            'created_at' => Yii::t('common','Created At'),
            'updated_at' => Yii::t('common','Updated At')
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->created_at=time();
                $this->updated_at=time();
            }
            else
                $this->updated_at=time();
            return true;
        }
        else
            return false;
    }

    public function getPosition()
    {
        return $this->hasOne(Position::className(),['id'=>'position_id']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(),['id'=>'department_id']);
    }
    
    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
}
