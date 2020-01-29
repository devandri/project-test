<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <?= Html::a('<i class="flaticon-arrows"></i> Easy Order', ['/admin-app/menu-easy-order'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="m-portlet__head-title">
                <?= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'menuParent.name',
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
            ],
            'route',
            'order',
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
                            'data-original-title' => 'View Menu',
                            'data-toggle' => 'm-tooltip'
                        ]);
                    },
                    'update'=>function ($url, $model) {
                        return Html::a('<i class="flaticon-edit"></i>', [$url], [
                            'class' => 'btn btn-info m-btn m-btn--icon m-btn--icon-only m--margin-right-5',
                            'data-original-title' => 'Update Menu',
                            'data-toggle' => 'm-tooltip'
                        ]);
                    },
                    'delete'=>function ($url, $model) {
                        return Html::a('<i class="flaticon-delete-2"></i>', [$url], [
                            'class' => 'btn btn-danger m-btn m-btn--icon m-btn--icon-only',
                            'data-original-title' => 'Delete Menu',
                            'data-toggle' => 'm-tooltip'
                        ]);
                    }
                ],
            ],
        ],
    ]);
    ?>
<?php Pjax::end(); ?>
</div>
</div>