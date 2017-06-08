<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%supplies_bound}}".
 *
 * @property integer $id
 * @property integer $cate_id
 * @property integer $operation_id
 * @property integer $supplie_id
 * @property integer $number
 */
class SuppliesBound extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%supplies_bound}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_id', 'operation_id', 'supplie_id', 'number'], 'required'],
            [['cate_id', 'operation_id', 'supplie_id', 'number'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'operation_id' => '手术项目名称',
            'supplie_id' => '耗材名称',
            'number' => '使用数量',
            'cate_id' => '耗材分类'
        ];
    }
}
