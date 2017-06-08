<?php
	use yii\helpers\Html;

	$this->title = Yii::t('common','搜索结果');
	$this->params['breadcrumbs'][] = ['label' => Yii::t('common','药品列表'), 'url' => ['leechdom/index']];
	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="table-responsive">
	<table class="table">
		<tr>
			<th>名称</th>
			<th>编号</th>
			<th>库存</th>
			<th>型号</th>
			<th>指导价格</th>
			<th>药品状态</th>
			<th>创建时间</th>
		</tr>
		<tr>
			<td><?=$res['name']?></td>
			<td><?=$res['number']?></td>
			<td><?=$res['stock']?></td>
			<td><?=$res['types']?></td>
			<td><?=$res['guide_price']?></td>
			<?php 
				$options = ['class' => 'btn btn-default'];
				if ($res['stock'] == 0) {
				    Html::removeCssClass($options, 'btn-default');
				    Html::addCssClass($options, 'btn-danger');
				    $value = '库存不足';
				}else if($res['stock'] < $res['stock_warning']){
					Html::removeCssClass($options, 'btn-default');
				    Html::addCssClass($options, 'btn-warning');
				    $value = '库存警告';
				}else{
					Html::removeCssClass($options, 'btn-default');
					Html::addCssClass($options, 'btn-success');
					$value = '库存正常';
				}
			?>
			<td><?=Html::tag('div',$value,$options);?></td>
			<td><?=date('Y-m-d h:i:s',$res['created_time'])?></td>
		</tr>
	</table>
</div>