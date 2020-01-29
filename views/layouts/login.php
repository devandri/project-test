<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

Yii::$app->response->headers->add('X-Frame-Options', 'DENY');

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <title><?= Html::encode(Yii::$app->view->title.' | '.Yii::$app->name) ?></title>
        <meta name="description" content="<?= Yii::$app->params['appDesc'] ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <?= Html::csrfMetaTags() ?>
        <script src="/temp/app/js/webfont.1.6.16.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <link href="/temp/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/temp/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <?php $this->head() ?>
        <link href="/temp/base/custom.css" rel="stylesheet" type="text/css" />
    </head>
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <?php $this->beginBody() ?>
        <?= $content ?>
        <script src="/temp/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="/temp/base/scripts.bundle.js" type="text/javascript"></script>
        <script src="/temp/app/js/login.js" type="text/javascript"></script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
