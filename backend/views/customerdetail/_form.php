<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-detail-form mt">

    <?php $form = ActiveForm::begin([

        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "
                            {label}
                            <div class='col-md-10 col-xs-9'>{input}</div>
                            <div class='col-xs-10 col-xs-offset-2'>{error}</div>
                            ",
            'labelOptions' => ['class' => 'col-md-2 col-xs-2 control-label'],]
    ]); ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">姓名</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> client_name, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">手机</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> telephone, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">会员卡</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> member_card, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">性别</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        $res -> member_card ? $res -> member_card = '男' : $res -> member_card = '女';
        echo Html::input('text', false, $res -> member_card, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>

    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">年龄</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> age, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">所属医院</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> store_id, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">渠道来源</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> source, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">市场人员</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> sale_id, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>

    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">录入人员</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> service_id, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">创建时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, date('Y-m-d h:i:s',$res -> created_time), ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">更新时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, date('Y-m-d h:i:s',$res -> updated_time), ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">备注消息</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res -> source, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>

    <?= $form->field($model, 'filecode')->textInput(['maxlength' => true]) ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">客户生日</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    echo DateRangePicker::widget([
        'name'=>'CustomerDetail[customer_birthday]',
        'value'=>$model->isNewRecord ?'':$model->customer_birthday,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>

    <!-- <?//= $form->field($model, 'customer_birthday')->textInput() ?> -->
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">配偶生日</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    echo DateRangePicker::widget([
        'name'=>'CustomerDetail[husband_birthday]',
        'value'=>$model->isNewRecord ?'':$model->husband_birthday,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <!-- <?//= $form->field($model, 'husband_birthday')->textInput() ?> -->
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">结婚纪念日</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    echo DateRangePicker::widget([
        'name'=>'CustomerDetail[merry_day]',
        'value'=>$model->isNewRecord ?'':$model->merry_day,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">孩子生日</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    echo DateRangePicker::widget([
        'name'=>'CustomerDetail[children_birthday]',
        'value'=>$model->isNewRecord ?'':$model->children_birthday,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <!-- <?//= $form->field($model, 'merry_day')->textInput() ?> -->

    <!-- <?//= $form->field($model, 'children_birthday')->textInput() ?> -->

    <?= $form->field($model, 'customer_nature')->dropDownList([ '0' => '冲动', '1' => '理性', '2' => '内敛寡言', '3' => '犹豫'], ['prompt' => '...请选择'])->label('顾客性格') ?>
    
    <?= $form->field($model, 'pay_times')->dropDownList([ '0' => '每周一次', '1' => '每周两次', '2' => '不定期', '3' => '不规律'], ['prompt' => '...请选择'])->label('来店护理次数') ?>

    <?= $form->field($model, 'habit')->dropDownList([ '0' => '诚信', '1' => '注重隐私 ', '2' => '赠品', '3' => '消费能力不够', '4' => '不舍得', '5' => '占便宜'], ['prompt' => '...请选择'])->label('顾客消费习惯') ?>
    
    <?= $form->field($model, 'attitude')->dropDownList([ '0' => '理智型', '1'=> '感情型', '2'=> '激动型', '3'=> '善谈型', '4'=> '少言型', '5'=> '其他型'], ['prompt' => '...请选择'])->label('顾客的消费态度') ?>
    
    <?= $form->field($model, 'emotion')->dropDownList([ '0' => '未婚', '1'=> '已婚 ', '2'=> '离婚', '3'=> '名存实亡'], ['prompt' => '...请选择'])->label('婚姻状况') ?>
    
    <?= $form->field($model, 'care_about')->dropDownList([ '0' => '效果', '1'=> '技术水平 ', '2'=> '服务细节水平', '3'=> '价格', '4'=> '客情'], ['prompt' => '...请选择'])->label('顾客最在意') ?>
    
    <?= $form->field($model, 'hobby')->dropDownList([ '0' => '购物', '1'=> '服装', '2'=> '旅游度假', '3'=> '餐饮', '4'=> '股市', '5'=> '购房', '6'=> '名车豪车', '7'=> '赌博'], ['prompt' => '...请选择'])->label('顾客的喜好') ?>
    
    <?= $form->field($model, 'years')->textInput()->label('在店内的消费年限(单位年)') ?>
    
    <?= $form->field($model, 'total_sals')->textInput(['maxlength' => true]) -> label('年消费总额(单位元)')?>

    <?= $form->field($model, 'healthy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plastic_items')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plastic_part')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'attidute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_manner')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'buy_type')->textInput() ->label('')?> -->

    <?= $form->field($model, 'buy_type')->dropDownList([ '0' => 'A类型(年消费--10万~以上)', '1' => 'B类型(年消费--5万~10万)', '2'=> 'C类型(年消费--1万~5万)', '3'=> 'D类型(年消费--1万以下)', ], ['prompt' => '...请选择']) -> label('顾客消费的档次')?>
    
    <?= $form->field($model, 'all_evaluate')->dropDownList([ '0' => '非常想做', '1' => '比较感兴趣', '2'=> '考虑下再说', '3'=> '暂不考虑', ], ['prompt' => '...请选择']) -> label('综合评价')?>
    
    <!-- <?//= $form->field($model, 'is_old_customer')->textInput() ?> -->
    
    <?= $form->field($model, 'is_old_customer')->dropDownList(['1'=>'是','0'=>'否'],['prompt'=>'...请选择'])->label('是否是老顾客') ?>
    
    <?= $form->field($model, 'backup')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true,'type' => 'hidden','value' => $res -> id])->label(false) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
