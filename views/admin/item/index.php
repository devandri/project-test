<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <?= Html::a(Yii::t('rbac-admin', 'Add ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-title"> </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('rbac-admin', 'Name'),
                    ],
                    [
                        'attribute' => 'ruleName',
                        'label' => Yii::t('rbac-admin', 'Rule Name'),
                        'filter' => $rules
                    ],
                    [
                        'attribute' => 'description',
                        'label' => Yii::t('rbac-admin', 'Description'),
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        'template' => '{view}{update}{delete}',
                        'contentOptions' => [
                            'style' => 'white-space: nowrap; width: 100px',
                        ],
                        'buttons'=>[
                            'view'=>function ($url, $model) {
                                return Html::a('<i class="flaticon-eye"></i>', [$url], [
                                    'class' => 'btn btn-primary m-btn m-btn--icon m-btn--icon-only m--margin-right-5',
                                    'data-original-title' => 'Update Permission',
                                    'data-toggle' => 'm-tooltip'
                                ]);
                            },
                            'update'=>function ($url, $model) {
                                return Html::a('<i class="flaticon-edit"></i>', [$url], [
                                    'class' => 'btn btn-info m-btn m-btn--icon m-btn--icon-only m--margin-right-5',
                                    'data-original-title' => 'Update Permission',
                                    'data-toggle' => 'm-tooltip'
                                ]);
                            },
                            'delete'=>function ($url, $model) {
                                return Html::a('<i class="flaticon-delete-2"></i>', [$url], [
                                    'class' => 'btn btn-danger m-btn m-btn--icon m-btn--icon-only',
                                    'data-original-title' => 'Delete Permission',
                                    'data-toggle' => 'm-tooltip'
                                ]);
                            }
                        ],
                    ],
                ],
            ])
            ?>
        </div>
    </div>
</div>