<?php
    use yii\widgets\Breadcrumbs;
    use dmstr\widgets\Alert;
?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>模块</small>' : '';
                } ?>
            </h1>
        <?php } ?>
        
        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <!-- <b>版本</b> -->
    </div>
    <strong>Copyright &copy; 2016-2017 TMOV.</strong> 版权所有　<b>豫ICP备17005100号</b>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">最近的活动</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::'>
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">兰登的生日</h4>

                            <p>将于4月24日23</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::'>
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo更新他的资料</h4>

                            <p>新电话+ 1（800）555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::'>
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora加入邮件列表</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::'>
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">作业254执行</h4>

                            <p>执行时间5秒</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">任务进度</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::'>
                        <h4 class="control-sidebar-subheading">
                            自定义模板的设计
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::'>
                        <h4 class="control-sidebar-subheading">
                            更新简历
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::'>
                        <h4 class="control-sidebar-subheading">
                            Laravel积分
                            <span class="label label-waring pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::'>
                        <h4 class="control-sidebar-subheading">
                            后端框架
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">一般设置</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        面板的使用报告
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        有关此常规设置选项的一些信息
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        允许邮件重定向
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        其他可用的选项集
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        在帖子中公开作者姓名
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        允许用户在博客帖子中显示自己的名字
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">聊天设置</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        显示我作为在线
                        <input type="checkbox" class="pull-right" checked/>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        关闭通知
                        <input type="checkbox" class="pull-right"/>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        删除的聊天记录
                        <a href="javascript::" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>