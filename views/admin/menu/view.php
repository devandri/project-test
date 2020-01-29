<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <?= Html::a('<i class="flaticon-arrows"></i> Easy Order', ['/admin-app/menu-easy-order'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-title">
                    <?= Html::a(Yii::t('rbac-admin', '<i class="la la-pencil"></i> Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a(Yii::t('rbac-admin', '<i class="la la-trash"></i> Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'menuParent.name:text:Parent',
                    'name',
                    'route',
                    'order',
                    [
                        'label' => 'Icon',
                        'value' => function($model){
                            $data = json_decode($model->data);
                            return $data->icon;
                        }
                    ],
                    [
                        'label'  => 'Active Route',
                        'format' => 'raw',
                        'value'  => function($model){
                            $data = json_decode($model->data);
                            if (isset($data->active_routes) && !empty($data->active_routes)) 
                                return implode("<br>", $data->active_routes);
                            else
                                return '-';
                        }
                    ]
                ],
            ])
            ?>
        </div>
    </div>
</div>
