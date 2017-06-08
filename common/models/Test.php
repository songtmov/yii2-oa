<?php

namespace common\models;
use common\models\UserModel;
use Yii;

/**
 * This is the model class for table "{{%test}}".
 *
 * @property string $id
 * @property string $username
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%test}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'username'], 'string', 'max' => 2],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','编号'),
            'username' => Yii::t('common','名称'),
        ];
    }

    public function getUser(){
        return $this->hasOne(UserModel::className(),['id'=>'id']);
    }
}
