<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'header' => 'Action',
    'template' => '{view}',
    'contentOptions' => ['style' => 'white-space: nowrap; width: 1%;', 'class' => 'text-center'],
    'buttons'=>[
        'view'=>function ($url, $model) {
                return Html::a('<i class="flaticon-eye"></i>', ['view', 'id' => $model->id], [
                    'class' => 'btn btn-primary m-btn m-btn--icon m-btn--icon-only',
                    'data-original-title' => 'Assign Owner'
                ]);
        },
    ]
];
?>
<div class="assignment-index">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-title"> </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <?php Pjax::begin(); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>