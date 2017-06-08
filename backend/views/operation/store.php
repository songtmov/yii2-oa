<?php 
	$this->title = Yii::t('common',$title);
	$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
	// p($res);die;
?>

<style>
	#id{
		margin-top: 10px;
		/*margin-left: 10%;*/
	}
	#a{
		margin-right: 1%;
	}
</style>

<?php $num = 0 ;?>

<?php foreach ($res as $key => $value): ?>
	
	<?php if ($num%8==0): ?>
		<div id="id">
		
		<a href="/operation/cstore/<?=$value->id?>?c=<?=$value->store_name;?>" id="a"><button type="button" class="btn btn-default"><?=$value->store_name;?></button></a>
		
	<?php else: ?>
		
	<a href="/operation/cstore/<?=$value->id?>?c=<?=$value->store_name;?>"><button type="button" class="btn btn-default"><?=$value->store_name;?></button></a>
		
		<?php if ($num%5==0): ?>
			</div>
		<?php endif ?>
	
	<?php endif ?>
	
	<?php $num++;?>
	
<?php endforeach ?>










