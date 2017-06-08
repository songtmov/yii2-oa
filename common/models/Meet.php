<?php

namespace common\models;

use Yii;
use common\models\City;
/**
 * This is the model class for table "{{%meet}}".
 *
 * @property string $id
 * @property string $name
 * @property string $space
 * @property string $time
 * @property string $address
 * @property string $remark
 * @property string $test_list
 * @property string $train
 * @property string $hotel_time
 * @property string $hotel_people
 */
class Meet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meet}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'space', 'time', 'address', 'test_list', 'train', 'hotel_time'], 'required'],
            [['time','hotel_time','create_time'],'integer'],
            [['name', 'space', 'address', 'remark' ,'train'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','会务编号'),
            'name' => Yii::t('common','会务名称'),
            'space' => Yii::t('common','会务场地'),
            'time' => Yii::t('common','会务时间'),
            'address' => Yii::t('common','会务地址'),
            'remark' => Yii::t('common','会务备注'),
            'test_list' => Yii::t('common','打板人员名单'),
            'train' => Yii::t('common','培训情况'),
            'hotel_time' => Yii::t('common','住店老师时间'),
            'create_time' => Yii::t('common','创建时间'),
        ];
    }

    public function getCityList($pid)
    {
        $model = City::findAll(array('pid'=>$pid));
        return ArrayHelper::map($model, 'id', 'name');
    }
}
