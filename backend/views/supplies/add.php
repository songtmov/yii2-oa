<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Supplies;

$Supplies = new Supplies();
$this->title = Yii::t('common', $title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Html::jsFile('@web/statics/js/jquery.js') ?>

<?= Html::beginForm(['addlogin'], 'post', ['enctype' => 'multipart/form-data']) ?>

<?= Html::label('选择耗材', 'username', ['class' => '']) ?>

<?= Html::dropDownList('id', '', ArrayHelper::map($Supplies::find()->all(), 'id', 'name'),['class'=>'form-control','prompt'=>'请点击选择耗材......']) ?><br>

<?= Html::label('现有数量', 'label', ['class' => '']) ?>

<?= Html::input('text', 'new_stock', '', ['class' => 'form-control','disabled' => 'disabled','id'=>'disabledTextInput']) ?><br>

<?= Html::label('添加数量', 'label', ['class' => '']) ?>

<?= Html::input('text', 'add_stock', '', ['class' => 'form-control','id'=>'disabledTextInput ']) ?><br>

<?= Html::label('添加后数量', 'label', ['class' => '']) ?>

<?= Html::input('text', 'end_stock', '', ['class' => 'form-control','disabled' => 'disabled','id'=>'disabledTextInput']) ?><br>

<?= Html::label('选择状态', 'label', ['class' => '']) ?><br>

<!-- <?//= Html::radioList('status', [40, 120], ArrayHelper::map(['1' => ['id' => '1','name' => '正常'],'0' => ['id' => '0','name' => '停售']], 'id', 'name')) ?><br> -->

<input type="radio" value="1" name="status" checked="checked">正常　
<input type="radio" value="0" name="status">停售
<h5>　</h5>

<?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>

<?= Html::resetButton('重置', ['class' => 'btn btn-danger']) ?>

<?= Html::input('hidden','_csrf',Yii::$app->request->csrfToken)?>

<?= Html::endForm() ?>

<script type="text/javascript">
	$(function(){
		$('select[name="id"]').blur(function(){
			var id = $(this).val();
			$.ajax({
				type:'POST',
				url:"/supplies/add",
				data:{'id':id},
				async:false,
				success:function(res){
					$("input[name='new_stock']").attr('value',res);
				},
				error:function(){
					alert('error');
				}
			});
		});

		$('input[name="add_stock"]').blur(function(){
			var one = $("input[name='new_stock']").attr('value');
			var two = $(this).val();
			if(one == ''){
				alert('您还未选择耗材，请选择耗材！');
			}else{
				var end = parseInt(one) + parseInt(two);
				$('input[name="end_stock"]').attr('value',end);
			}
		});

	});
</script>


