<?php

use mdm\admin\AnimateAsset;
// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="auth-item-view">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title"></div>
            </div>
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-title">
                    <?=Html::a(Yii::t('rbac-admin', '<i class="la la-pencil"></i> Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']);?>
                    <?=Html::a(Yii::t('rbac-admin', '<i class="la la-trash"></i> Delete'), ['delete', 'id' => $model->name], [
                        'class'        => 'btn btn-danger',
                        'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
                        'data-method'  => 'post',
                    ]);?>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-sm-5">
                    <input class="form-control search" data-target="available"
                           placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
                    <select multiple size="20" class="form-control list" data-target="available"></select>
                </div>
                <div class="col-sm-1">
                    <br><br>
                    <?=Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => $model->name], [
                        'class'       => 'btn btn-success btn-assign',
                        'data-target' => 'available',
                        'title'       => Yii::t('rbac-admin', 'Assign'),
                    ]);?><br><br>
                    <?=Html::a('&lt;&lt;' . $animateIcon, ['remove', 'id' => $model->name], [
                        'class'       => 'btn btn-danger btn-assign',
                        'data-target' => 'assigned',
                        'title'       => Yii::t('rbac-admin', 'Remove'),
                    ]);?>
                </div>
                <div class="col-sm-5">
                    <input class="form-control search" data-target="assigned"
                           placeholder="<?=Yii::t('rbac-admin', 'Search for assigned');?>">
                    <select multiple size="20" class="form-control list" data-target="assigned"></select>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- <div class="row">
        <div class="col-sm-11">
            <?=
DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'description:ntext',
        'ruleName',
        'data:ntext',
    ],
    'template' => '<tr><th style="width:25%">{label}</th><td>{value}</td></tr>',
]);
?>
        </div>
    </div> -->