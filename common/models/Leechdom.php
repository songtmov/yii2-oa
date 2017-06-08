<?php

namespace common\models;

use backend\models\Store;
use common\category\Category;
use Yii;

/**
 * This is the model class for table "mly_leechdom".
 *
 * @property string $id
 * @property string $name
 * @property string $cate_id
 * @property string $number
 * @property integer $stock
 * @property string $types
 * @property string $standard
 * @property string $guide_price
 * @property integer $status
 * @property integer $stock_warning
 * @property integer $store_id
 * @property integer $created_time
 * @property integer $updated_time
 */
class Leechdom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mly_leechdom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cate_id', 'stock', 'types', 'standard', 'guide_price', 'status'], 'required'],
            [['cate_id', 'stock', 'status', 'stock_warning', 'store_id', 'created_time', 'updated_time'], 'integer'],
            [['guide_price'], 'number'],

            ['number', 'trim'],
            ['number', 'string', 'max' => 255],
            ['number', 'unique', 'targetClass' => '\common\models\Leechdom', 'message' => '该编号已经被使用了'],

            [['name'], 'string', 'max' => 30],
            [['number', 'types'], 'string', 'max' => 20],
            [['standard'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'name' => Yii::t('common','Name'),
            'cate_id' => Yii::t('common','Cate ID'),
            'number' => Yii::t('common','Number'),
            'stock' => Yii::t('common','Stock'),
            'types' => Yii::t('common','Types'),
            'standard' => Yii::t('common','Standard'),
            'guide_price' => Yii::t('common','Guide Price'),
            'status' => Yii::t('common','Status'),
            'stock_warning' => Yii::t('common','Stock Warning'),
            'store_id' => Yii::t('common','Store ID'),
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
    public function getOption()
    {
        $data = \backend\models\Category::find()->asArray()->where(['status'=>1])->all();
        $tree = Category::getClassify($data,1);
        $list = [];
        foreach($tree as $v){
            $list[$v['id']] = $v['name'];
        }
        return $list;
    }

    /***
     * @return \yii\db\ActiveQuery
     */
    public function getCate()
    {
        return $this->hasOne(\common\models\Category::className(),['id'=>'cate_id']);
    }

    /***
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
}
