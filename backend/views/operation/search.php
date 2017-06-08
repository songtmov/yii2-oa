<?php
$time = explode('-', $time);

if($time[0] && $time[1]){
  $this->title = Yii::t('common',$title.date('Y-m-d',$time[0]).'至'.date('Y-m-d',$time[1]));
}else{
  // p($c);die;
  $this->title = Yii::t('common',$c.':'.$title);
}
$this->params['breadcrumbs'][] = $this->title;
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th>客户名</th>
      <th>项目名称</th>
      <th>医生</th>
		
      <th>医助</th>
      <th>护士</th>
      <th>手术费用</th>

      <th>咨询师</th>
      <th>所属门店</th>
      <th>销售人员</th>
	  
      <th>手术开始时间</th>
      <th>创建时间</th>
    </tr>
  </thead>
  <tbody>
  	<?php $num = 0;?>
	<?php foreach ($res as $k => $v): ?>
    <tr>
      <th scope="row"><?=$v['client_id'];?></th>
      <td><?=$v['surgical_id'];?></td>
      <td><?=$v['hakim_id'];?></td>

      <td><?=$v['assistant_id'];?></td>
      <td><?=$v['nurse_id'];?></td>
      <td>¥<?=$v['surgery_cost'];?></td>
		
      <td><?=$v['counselor_id'];?></td>
      <td><?=$v['store_id'];?></td>
      <td><?=$v['sale_id'];?></td>
	
      <td><?=$v['operation_time'];?></td>
      <td><?=date('Y-m-d h:i:s',$v['created_time']);?></td>
    </tr>
	<?php 
		$num  = $num + $v['surgery_cost'];
	?>
	<?php endforeach ?>
	
  </tbody>
</table>

<div style="float: right;">
	<h3>业绩统计：<span style="color: red;">¥<?=$num;?></span></h3>
</div>


