<?php
// exit;
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
// use yii\helpers\Html;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

Yii::$app->response->headers->add('X-Frame-Options', 'DENY');

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>" >
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <title><?=Html::encode(Yii::$app->view->title . ' | ' . Yii::$app->name)?></title>
    <meta name="description" content="<?=Yii::$app->params['appDesc']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <?=Html::csrfMetaTags()?>
    <script src="/temp/app/js/webfont.1.6.16.js"></script>
    <script>
        WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
        });
    </script>
    <link href="/temp/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/temp/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/temp/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <?php $this->head()?>
    <link href="/temp/base/custom.css" rel="stylesheet" type="text/css" />
</head>
<body  class="m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default"  >
    <?php $this->beginBody()?>
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <header id="m_header" class="m-grid__item    m-header "  m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="200" m-minimize-mobile-offset="200" >
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop  m-header__wrapper">
                    <div class="m-stack__item m-brand m-brand--mobile">
                        <div class="m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="/" class="m-brand__logo-wrapper">
                                    <h4>MARKETPLACE</h4>
                                </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <a href="javascript:;" id="m_aside_left_toggle_mobile" class="m-brand__icon m-brand__toggler m-brand__toggler--left">
                                    <span></span>
                                </a>
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon">
                                    <i class="flaticon-more"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-stack__item--left m-header-head" id="m_header_nav">
                        <div class="m-stack m-stack--ver m-stack--desktop">
                            <div class="m-stack__item m-stack__item--middle m-stack__item--fit">
                                <a href="javascript:;" id="m_aside_left_toggle" class="m-aside-left-toggler m-aside-left-toggler--left m_aside_left_toggler"><span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-stack__item--center">
                        <a href="/" class="m-brand m-brand--desktop">
                            <h4>MARKETPLACE</h4>
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--right">
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                        <?php if (1): ?>
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
                                            <span class="m-topbar__username m--hidden-mobile">Admin</span>
                                            <span class="m-nav__link-icon">
                                                <span class="m-nav__link-icon-wrapper">
                                                    <i class="flaticon-user"></i>
                                                </span>
                                            </span>
                                        </a>
                                        <?php endif;?>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav m-nav--skin-light">
                                                            <li class="m-nav__item">
                                                                <a href="/user/update-account" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-user-ok"></i>
                                                                    <span class="m-nav__link-text">Edit Account</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit"></li>
                                                            <li class="m-nav__item">
                                                                <a href="/site/logout" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-logout"></i>
                                                                    <span class="m-nav__link-text">Logout</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php echo Yii::$app->controller->renderPartial('//layouts/_menu'); ?>
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <div class="m-subheader ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title m-subheader__title--separator"><?=Html::encode($this->title)?></h3>
                                <?=Breadcrumbs::widget([
    'options' => ['class' => 'm-subheader__breadcrumbs m-nav m-nav--inline'],
    'encodeLabels' => false,
    'homeLink' => [
        'label' => '<i class="flaticon-dashboard"></i>',
        'url' => '/site/index',
        'class' => 'm-nav__link m-nav__link--icon',
        'template' => '<li class="m-nav__item m-nav__item--home"> {link} </li> <li class="m-nav__separator"> > </li>',
    ],
    'itemTemplate' => '<li class="m-nav__item"> {link} </li> <li class="m-nav__separator"> > </li>',
    'activeItemTemplate' => '<li class="m-nav__item"> {link} </li>',
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])?>
                            </div>
                        </div>
                    </div>
                    <div class="m-content">

                        <?=$content?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="m-grid__item  m-footer ">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                        <span class="m-footer__copyright">
                            <?=date('Y')?> <a href="#">Marketplace.</a>
                            </a>
                        </span>
                    </div>
                    <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                        <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                            <li class="m-nav__item">
                                <span href="#" class="m-nav__link">
                                    <span class="m-nav__link-text"><?=\cf\config::YII_ENV != 'prod' ? preg_replace('/[^\w]/', '', gethostname()) : ''?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <script src="/temp/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="/temp/base/scripts.bundle.js" type="text/javascript"></script>
    <script src="/temp/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
