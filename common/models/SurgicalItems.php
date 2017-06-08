<?php

namespace common\models;

use Yii;
use common\category\Category;
/**
 * This is the model class for table "{{%surgical_items}}".
 *
 * @property string $id
 * @property integer $parent_id
 * @property string $entry_name
 * @property string $guide_price
 * @property integer $sort
 * @property integer $store_id
 * @property integer $status
 * @property integer $created_time
 */
class SurgicalItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%surgical_items}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id','entry_name', 'guide_price', 'sort','status'], 'required'],
            [['parent_id','sort', 'store_id', 'status', 'created_time'], 'integer'],
            [['guide_price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'parent_id' => Yii::t('common','Parent ID'),
            'entry_name' => Yii::t('common','Entry Name'),
            'guide_price' => Yii::t('common','Guide Price'),
            'sort' => Yii::t('common','Sort'),
            'store_id' => Yii::t('common','Store ID'),
            'status' => Yii::t('common','Status'),
            'created_time' => Yii::t('common','Created Time'),
            'option' => Yii::t('common','方式选择'),
        ];
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->created_time=time();
            }
            return true;
        }
        else
            return false;
    }

    public function getOptions(){

        $data = self::find()->where(['status'=>1])->asArray()->all();

        $tree = Category::getTree($data);

        $list = ['顶级分类'];

        foreach($tree as $v){

            $list[$v['id']]=$v['entry_name'];

        }

        return $list;
    }

    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
    public function getParent()
    {
        return $this->hasOne(self::className(),['id'=>'parent_id']);
    }

    public function getSupplier()
    {
        return $this->hasMany(SuppliesBound::className(),['operation_id' => 'id']);
        return $this->hasMany(SuppliesBound::className(), ['operation_id' => 'id']);
    }
}
