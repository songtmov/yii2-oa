<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
$this->title = Yii::t('common','开单');
$this->params['breadcrumbs'][] = $this->title;
?>
<table class="table table-bordered">
    <tr>
        <th><b>姓名</b></th>
        <td><?=$data['client_name']?></td>
        <th><b>年龄</b></th>
        <td><?=$data['age']?>岁</td>
    </tr>
    <tr>
        <th><b>性别</b></th>
        <td><?=$data['sex'] == 0 ? '女':'男'?></td>
        <th><b>电话</b></th>
        <td><?=$data['telephone']?></td>
    </tr>
    <tr>
        <th><b>会员卡</b></th>
        <td><?=$data['member_card']?></td>
        <th><b>来源渠道</b></th>
        <td><?=\common\models\Customer::$static[$data['source']]?></td>
    </tr>
</table>
<form action="/customer/openlistpost" method="post">
	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
	<b>手术项目选择</b>
	<?= Select2::widget(['name' => 'surgical_id','value' => '','data' => $surgical,'options' => ['multiple' => true, 'placeholder' => '添加手术...']]);?>
	<div><b>医生</b></div>
	<?php foreach ($role['hakim'] as $key => $value): ?>
		<label><input name="hakim_id[]" type="checkbox" value="<?=$value->username;?>"> <?=$value->username;?></label>
	<?php endforeach ?>
	<div><b>护士</b></div>
	<?php foreach ($role['nurse'] as $key => $value): ?>
		<label><input name="nurse_id[]" type="checkbox" value="<?=$value->username;?>"> <?=$value->username;?></label>
	<?php endforeach ?>
	<div><b>助理</b></div>
	<?php foreach ($role['assistant'] as $key => $value): ?>
		<label><input name="assistant_id[]" type="checkbox" value="<?=$value->username;?>"> <?=$value->username;?></label>
	<?php endforeach ?>
	<div><b>手术时间</b></div>
	<div class="col-md-6">
	<?php echo DateRangePicker::widget([
	    'model'=>$model,
	    'attribute'=>'operation_time',
	    'convertFormat'=>true,
	    'pluginOptions'=>[
	        'timePicker'=>true,
	        'timePickerIncrement'=>30,
	        'locale'=>[
	            'format'=>'Y-m-d h:i A'
	        ]
	    ]
	]);?>
	</div>
	<input type="hidden" name="id" value="<?=$_GET['id'];?>">
	<br>
	<br>
	<br>
	<div class="col-md-6">
		<button class="btn btn-success">确定提交</button>
		<input type="reset" class="btn btn-danger" value="重新输入">
	</div>
</form>




