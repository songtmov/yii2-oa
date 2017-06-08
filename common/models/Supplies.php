<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mly_supplies".
 *
 * @property string $id
 * @property string $name
 * @property integer $cate_id
 * @property integer $stock
 * @property string $types
 * @property integer $store_id
 * @property integer $status
 * @property integer $stock_warning
 */
class Supplies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mly_supplies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cate_id', 'stock', 'types', 'store_id', 'status'], 'required'],
            [['cate_id', 'stock', 'store_id', 'status', 'stock_warning'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['types'], 'string', 'max' => 20],
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
            'stock' => Yii::t('common','Stock'),
            'types' => Yii::t('common','Types'),
            'store_id' => Yii::t('common','Store ID'),
            'status' => Yii::t('common','Status'),
            'stock_warning' => Yii::t('common','Stock Warning'),
        ];
    }
    public function getOption()
    {
        $data = \backend\models\Category::find()->asArray()->where(['status'=>1])->all();
        $tree = \common\category\Category::getClassify($data,2);
        $list = [];
        foreach($tree as $v){
            $list[$v['id']] = $v['name'];
        }
        return $list;
    }
    public function getCate()
    {
        return $this->hasOne(\common\models\Category::className(),['id'=>'cate_id']);
    }
    public function getStore()
    {
        return $this->hasOne(Store::className(),['id'=>'store_id']);
    }
}
