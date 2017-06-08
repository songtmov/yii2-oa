<?php



use yii\helpers\Url;



$this->title = '药品开单成功';

?>



<div class="alert alert-success" role="alert">

    <h2>药品开单成功。</h2>

    系统将在 <span id="time">5</span> 秒钟后自动跳转至手术安排列表，如果未能跳转，<a href="<?= Url::to(['/billing/arrange-operation']) ?>" title="点击访问">请点击这里</a>。</p>

</div>



<script type="text/javascript">

    delayURL();

    function delayURL() {

        var delay = document.getElementById("time").innerHTML;

        var t = setTimeout("delayURL()", 1000);

        if (delay > 0) {

            delay--;

            document.getElementById("time").innerHTML = delay;

        } else {

            clearTimeout(t);

            window.location.href = '<?=Url::to(['/billing/arrange-operation'])?>';

        }

    }

</script>