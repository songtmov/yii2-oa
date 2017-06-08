<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_detail}}".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $filecode
 * @property string $customer_birthday
 * @property string $husband_birthday
 * @property string $merry_day
 * @property string $children_birthday
 * @property string $customer_nature
 * @property string $pay_times
 * @property string $habit
 * @property string $attitude
 * @property string $emotion
 * @property string $care_about
 * @property string $hobby
 * @property integer $years
 * @property string $total_sals
 * @property string $healthy
 * @property string $plastic_items
 * @property string $plastic_part
 * @property string $attidute
 * @property string $hospital
 * @property string $old_manner
 * @property integer $buy_type
 * @property string $all_evaluate
 * @property integer $is_old_customer
 * @property string $backup
 */
class CustomerDetail extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_detail}}';
    }

    public static $customer_nature = [
        '0' => '冲动',
        '1' => '理性',
        '2' => '内敛寡言',
        '3' => '犹豫'
    ];

    public static $pay_times = [
        '0' => '每周一次',
        '1' => '每周两次',
        '2' => '不定期',
        '3' => '不规律'
    ];

    public static $habit = [
     // : 0 诚信 1 注重隐私  2 赠品  3消费能力不够 4 不舍得 5 占便宜
        '0' => '诚信',
        '1' => '注重隐私',
        '2' => '赠品',
        '3' => '消费能力不够',
        '4' => '不舍得',
        '5' => '占便宜'
    ];

    public static $attitude = [
     // 1 感情型 2 激动型 3善谈型 4 少言型 5 其他型
        '0' => '理智型',
        '1' => '感情型',
        '2' => '激动型',
        '3' => '善谈型',
        '4' => '少言型',
        '5' => '其他型'
    ];

    public static $emotion = [
     //  婚姻状况：0 未婚 1 已婚 2 离婚  3 名存实亡 
        '0' => '未婚',
        '1' => '已婚',
        '2' => '离婚',
        '3' => '名存实亡',
        // '4' => '少言型',
        // '5' => '其他型'
    ];
    public static $care_about = [
     //  ：0 效果 1 技术水平 2 服务细节水平  3 价格  4 客情 
        '0' => '效果',
        '1' => '技术水平',
        '2' => '服务细节水平',
        '3' => '价格',
        '4' => '客情',
        // '5' => '其他型'
    ];
    public static $hobby = [
     //  ：0 购物 1 服装 2 旅游度假  3 餐饮  4 股市  5 购房 6 名车豪车 7 赌博 
        '0' => '购物',
        '1' => '服装',
        '2' => '旅游度假',
        '3' => '餐饮',
        '4' => '股市',
        '5' => '购房',
        '6' => '名车豪车',
        '7' => '赌博'
        // '5' => '其他型'
        // '5' => '其他型'
    ];

    public static $all_evaluate = [
     //  ：0  非常想做 1  比较感兴趣  2 考虑下再说  3 暂不考虑 
        '0' => '非常想做',
        '1' => '比较感兴趣',
        '2' => '考虑下再说',
        '3' => '暂不考虑',
        // '4' => '股市',
        // '5' => '购房',
        // '6' => '名车豪车',
        // '7' => '赌博'
        // '5' => '其他型'
        // '5' => '其他型'
    ];

    public static $is_old_customer = [
     //  ：0  非常想做 1  比较感兴趣  2 考虑下再说  3 暂不考虑 
        '0' => '是',
        '1' => '否',
    ];

    public static $type = [
        0 => 'A类型',
        1 => 'B类型',
        2 => 'C类型',
        3 => 'D类型'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'customer_birthday', 'husband_birthday', 'years', 'total_sals', 'healthy', 'plastic_items', 'plastic_part', 'attidute', 'hospital', 'old_manner', 'buy_type', 'is_old_customer'], 'required'],
            [['customer_id', 'years', 'buy_type', 'is_old_customer'], 'integer'],
            [['customer_birthday', 'husband_birthday', 'merry_day', 'children_birthday'], 'safe'],
            [['customer_nature', 'pay_times', 'habit', 'attitude', 'emotion', 'care_about', 'hobby', 'all_evaluate', 'backup'], 'string'],
            [['total_sals'], 'number'],
            [['filecode'], 'string', 'max' => 15],
            [['healthy', 'plastic_items'], 'string', 'max' => 200],
            [['plastic_part'], 'string', 'max' => 30],
            [['attidute'], 'string', 'max' => 100],
            [['hospital'], 'string', 'max' => 60],
            [['old_manner'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','自增ID'),
            'customer_id' => Yii::t('common',' 顾客名'),
            'filecode' => Yii::t('common',' 档案号'),
            'customer_birthday' => Yii::t('common','顾客生日'),
            'husband_birthday' => Yii::t('common','老公生日'),
            'merry_day' => Yii::t('common','结婚纪念日'),
            'children_birthday' => Yii::t('common','孩子生日'),
            'customer_nature' => Yii::t('common',' 顾客性格'),
            'pay_times' => Yii::t('common',' 来店护理次数'),
            'habit' => Yii::t('common',' 顾客消费习惯'),
            'attitude' => Yii::t('common',' 顾客的消费态度'),
            'emotion' => Yii::t('common',' 婚姻状况'),
            'care_about' => Yii::t('common',' 顾客最在意的'),
            'hobby' => Yii::t('common',' 顾客的喜好及禁忌'),
            'years' => Yii::t('common',' 在店内的消费年限 '),
            'total_sals' => Yii::t('common','年消费总额'),
            'healthy' => Yii::t('common','顾客的身体健康状况'),
            'plastic_items' => Yii::t('common','曾经做过的整形项目'),
            'plastic_part' => Yii::t('common','最想改变的部位'),
            'attidute' => Yii::t('common','对整形的态度'),
            'hospital' => Yii::t('common','了解哪家整形医院'),
            'old_manner' => Yii::t('common','对抗衰老的看法'),
            'buy_type' => Yii::t('common','顾客消费档次类型'),
            'all_evaluate' => Yii::t('common',' 综合评价'),
            'is_old_customer' => Yii::t('common','是否老客户'),
            'backup' => Yii::t('common','调查备注'),
        ];
    }
    
    public function getCustomer(){
        return $this->hasOne(Customer::className(),['id'=>'customer_id']);
    }
}
