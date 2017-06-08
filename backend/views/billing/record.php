<?php

?>





<table class="table table-striped table-bordered">

    <thead>

        <tr>

            <th>手术项目</th>

            <th>执刀医师</th>

            <th>医师助理</th>

            <th>护士</th>

            <th>咨询师</th>

            <th>手术费用</th>

            <th>手术时间</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach($model as $value):?>

        <tr>

            <td><?=$value->surgical->entry_name?></td>

            <td><?=$value->hakim->username?></td>

            <td><?=$value->assistant->username?></td>

            <td><?=$value->nurse->username?></td>

            <td><?=$value->counselor->username?></td>

            <td><?=$value->surgery_cost?></td>

            <td><?=$value->operation_time?></td>

        </tr>

        <?php endforeach?>

    </tbody>

</table>

