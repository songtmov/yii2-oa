<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use common\models\Overtime;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Overtime */
/* @var $form yii\widgets\ActiveForm */
?>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <style type="text/css">
      body,html,#container{
        height: 100%;
        margin: 0px
      }
      .panel {
        background-color: #ddf;
        color: #333;
        border: 1px solid silver;
        box-shadow: 3px 4px 3px 0px silver;
        position: absolute;
        top: 10px;
        right: 10px;
        border-radius: 5px;
        overflow: hidden;
        line-height: 20px;
        position: absolute;
        top:70%;
        /*margin-bottom: 10%;*/
        left: 18%;
        width: 30%;
        margin-bottom: 5%;
        /*height:30px;*/
      }
      #input{
        width: 250px;
        height: 25px;
        border: 0;
      }
      #container{
        width: 81%;
        height:300px;
        position: relative;
        left: 18%;
        margin-bottom: 3%;
      }
      .field-overtime-work_reason{
            margin:150px 0 0 0;
      }
      #map{
        position: absolute;
        top:48%;
        left: 7%;
      }
    </style>
</head>

<div class="overtime-form mt">

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
      
    <?= $form->field($model, 'fill_time')->textInput(['maxlength' => true,'type' => 'hidden','value' => time()])->label(false) ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">姓名</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res[0], ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">医院</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res[2] -> name, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">部门</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res[1] -> name, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">职位</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, $res[3] -> name, ['class' => 'form-control','disabled'=>"value"]);
        echo '</div></div>';
    ?>
    
    <?= $form->field($model, 'work_time')->widget('kartik\daterange\DateRangePicker',[
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'timePicker'=>true,
                    'timePickerIncrement'=>1,
                    'locale'=>['format'=>'Y-m-d H:i:s']
                ]
            ]);
    ?>
    <div id="container" tabindex="0"></div>
   <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=40a8e84b896b9f0563ff3e1dc1af5974"></script>
   <script type="text/javascript">
    var map = new AMap.Map('container',{
            resizeEnable: true,
            zoom: 13,
            center: [116.39,39.9]
    });
    AMap.plugin('AMap.Geocoder',function(){
        var geocoder = new AMap.Geocoder({
            city: "010"//城市，默认：“全国”
        });
        var marker = new AMap.Marker({
            map:map,
            bubble:true
        })
        var input = document.getElementById('input');
        var message = document.getElementById('message');
        map.on('click',function(e){
            marker.setPosition(e.lnglat);
            geocoder.getAddress(e.lnglat,function(status,result){
              if(status=='complete'){
                 input.value = result.regeocode.formattedAddress
                 message.innerHTML = ''
              }else{
                 message.innerHTML = '无法获取地址'
              }
            })
        })
        input.onchange = function(e){
            var address = input.value;
            geocoder.getLocation(address,function(status,result){
              if(status=='complete'&&result.geocodes.length){
                marker.setPosition(result.geocodes[0].location);
                map.setCenter(marker.getPosition())
                message.innerHTML = ''
              }else{
                message.innerHTML = '无法获取位置'
              }
            })
        }
    });
   </script>
   <script type="text/javascript" src="http://webapi.amap.com/demos/js/liteToolbar.js"></script>
    <span id="map"><b>位置</b></span>
    <div class ='panel'>
        <input id = 'input' name="work_address" value = '<?php if(!$model -> work_address){echo '　输入地址/地理位置';}else{echo $model -> work_address;}?>' onfocus = 'this.value=""'></input>
        <div id = 'message'></div>
    </div>
    
    <?= $form->field($model, 'work_reason')->textarea(['rows' => 6]) ?>
    
    <!-- <?//= $form->field($model, 'executive_opinion')->textarea(['rows' => 6]) ?> -->
    
    <!-- <?//= $form->field($model, 'department_opinion')->textarea(['rows' => 6]) ?> -->
    
    <!-- <?//= $form->field($model, 'manager_opinion')->textarea(['rows' => 6]) ?> -->

    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
