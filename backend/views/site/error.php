<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h2 style="font-weight: 600"><?= $name ?></h2>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                Web服务器正在处理您的请求时发生上述错误。
                如果你认为这是一个服务器错误。
                请联系我们，谢谢您.
                同时，您可以<a href='<?= Yii::$app->homeUrl ?>'>返回到首页</a>或尝试使用搜索
                形式。

            </p>

            <form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="Search"/>

                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
