<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mly_category".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property integer $status
 * @property string $sort
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mly_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'status', 'sort'], 'required'],
            [['parent_id', 'status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 30],
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
            'name' => Yii::t('common','Name'),
            'status' => Yii::t('common','Status'),
            'sort' => Yii::t('common','Sort'),
        ];
    }
    public function getOptions()
    {
        $data = self::find()->where(['status'=>1])->all();

        $tree = \common\category\Category::getClassify($data);

        $list =['顶级分类'];
        foreach ($tree as $key => $v){
            $list[$v['id']]=$v['name'];
        }
        return $list;
    }
    public function getCate()
    {
        return $this->hasOne(Category::className(),['id'=>'parent_id']);
    }
}
