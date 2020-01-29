<?php
use yii\helpers\Url;
// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;

$this->title = $name;
?>
    <div class="m-error_subtitle m--font-light">
        <h1><?=isset($exception->statusCode) ? $exception->statusCode : "500"?></h1>
    </div>
        <h3 class="m-error_description m--font-light"><?= nl2br(Html::encode($message)) ?> <small><?= Html::encode($this->title) ?></small></h3>
        <p class="m--font-light">The above error occurred while the Web server was processing your request.</p>
        <p class="m--font-light">Please contact us if you think this is a server error. Thank you.</p>
        <br />
        <h4 class="m--font-light">
            Return <a href="/" class="btn btn-primary m-btn m-btn--icon"><span><i class="fa flaticon-dashboard"></i><span>Dashboard</span></span></a>
            <?php
            if ($exception->statusCode == '403') {
                echo 'or <a href="/site/logout" class="btn btn-warning m-btn m-btn--icon"><span><i class="fa flaticon-logout"></i><span>Logout</span></span></a>';
            } else if ($exception->statusCode == '400') {
                echo 'or <a href="'.\Yii::$app->request->referrer.'" class="btn btn-warning m-btn m-btn--icon"><span><i class="fa fa-arrow-left"></i><span>Go Back</span></span></a>';
            } else {
                echo '';
            }
            ?>
        </h4>
    </p>