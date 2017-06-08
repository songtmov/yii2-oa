<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\UserModel;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<header class="main-header">
    <?= Html::a('<span class="logo-mini">OA</span><span class="logo-lg">TMOV</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">切换导航</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a>当前位置： <b id="address"></b>-<b id="type"></b></a></li>
                <script type="text/javascript">
                   $(function(){
                        var url = 'http://chaxun.1616.net/s.php?type=ip&output=json&callback=?&_=' + Math.random();
                        $.getJSON(url, function (data) {
                            var ip = data.Ip;
                            $.ajax({
                                type: "POST",
                                url: "/visit/ip",
                                data: {ip:ip},
                                success: function(data){
                                    var item = jQuery.parseJSON(data);
                                    var area = item.result.area;
                                    $('#address').text(area);
                                    var location = item.result.location;
                                    $('#type').text(location);
                                }
                            });
                        });
                   });
                </script>
                <!-- <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-success">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">你有10个通知</li>
                        <li> -->
                            <!-- inner menu: contains the actual data -->
                            <!-- <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 今天加入了5个新成员
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25销售
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="footer"><a href="#">查看所有</a></li>
                    </ul>
                </li> -->
                <!-- <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">你有10个通知</li>
                        <li> -->
                            <!-- inner menu: contains the actual data -->
                           <!--  <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 今天加入了5个新成员
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25销售
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="footer"><a href="#">查看所有</a></li>
                    </ul>
                </li> -->
                <!-- Tasks: style can be found in dropdown.less -->
                <!-- <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">你有9个任务</li>
                        <li> -->
                            <!-- inner menu: contains the actual data -->
                            <!-- <ul class="menu"> -->
                                <!-- <li>Task item -->
                                   <!--  <a href="#">
                                        <h3>
                                            设计一些按钮
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">完成 20%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li> -->

                                <!-- end task item -->
                                <!-- <li>Task item -->
                                <!--     <a href="#">
                                        <h3>
                                            创造一个好的主题
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">完成 40%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                       <!--  <li class="footer">
                            <a href="#">查看所有</a>
                        </li>
                    </ul>
                </li> -->
                <!-- User Account: style can be found in dropdown.less -->
                
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/logo.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->username?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/head.jpg" class="img-circle"
                                 alt="User Image"/>
                            <p>
                                <?=Yii::$app->user->identity->username?>
                                <small>注册于 . <?=date('Y-m-d',Yii::$app->user->identity->created_at)?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body"> -->
                            <!-- <div class="col-xs-4 text-center"> -->
                                <!-- <a href="#">追随者</a> -->
                            <!-- </div> -->
                            <!-- <div class="col-xs-4 text-center"> -->
                                <!-- <a href="#">销售额</a> -->
                            <!-- </div> -->
                            <!-- <div class="col-xs-4 text-center"> -->
                                <!-- <a href="#">朋友</a> -->
                            <!-- </div> -->
                        <!-- </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!-- <div class="pull-left"> -->
                                <!-- <a href="#" class="btn btn-default btn-flat"> -->
                                    <!-- 简况</a> -->
                            <!-- </div> -->
                            <div class="pull-right">
                                <?= Html::a(
                                    '退出登录',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                
                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li> -->
                    <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
                <!-- </li> -->
            </ul>
        </div>
    </nav>
</header>