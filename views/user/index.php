<?php
// exit('hai');
// use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss('
    .p2p-id{
        margin-right: 2px;
        font-size: 10px;
        padding: 6px;
        border-radius: 12px!important;
    }
');
// exit('exit');
?>
<div class="user-index">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <p>
                        <?=Html::a('Add User', ['create'], ['class' => 'btn btn-success pull-right'])?>
                    </p>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-title"></div>
            </div>
        </div>
        <div class="m-portlet__body">
            <?php //exit('exit');?>
            <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => "<div class='table-responsive'>{summary}\n{items}\n<nav class='custom-paging'>{pager}</nav>\n</div>",
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'header' => 'No',
            'headerOptions' => [
                'class' => 'text-center',
            ],
        ],
        // 'user_id',
        [
            'attribute' => 'username',
            'headerOptions' => [
                'class' => 'text-center',
            ],
        ],
        [
            'attribute' => 'email',
            'headerOptions' => [
                'class' => 'text-center',
            ],
        ],
        // 'password:ntext',
        // [
        //     'attribute' => 'is_p2p',
        //     'label' => 'Role',
        //     'value' => function ($model) {
        //         return ($model->is_p2p == 1) ? 'User P2P' : 'Admin';
        //     },
        //     'headerOptions' => [
        //         'class' => 'text-center',
        //     ],
        //     'filter' => [1 => 'User P2P', 0 => 'Admin'],
        // ],
        // [
        //     'attribute' => 'p2p_id',
        //     'header' => 'P2P(s)',
        //     'format' => 'raw',
        //     'headerOptions' => [
        //         'class' => 'text-center',
        //     ],
        //     'value' => function ($model) {
        //         if ($model->p2p_id != NULL && $model->p2p_id != '') {
        //             $p2p_ids = explode(';', $model->p2p_id);
        //             $val = '';
        //             foreach ($p2p_ids as $key => $value) {
        //                 $val .= '<span class="btn m-btn--pill btn-success p2p-id">' . $value . '</span>';
        //             }
        //             return $val;
        //         } else {
        //             return '<span class="btn m-btn--pill btn-warning p2p-id">All</span>';
        //         }
        //     },
        // ],
        // [
        //     'attribute' => 'is_ecoll',
        //     'label' => 'Ecoll User',
        //     'value' => function ($model) {
        //         return ($model->is_ecoll == 1) ? 'Yes' : 'No';
        //     },
        //     'headerOptions' => [
        //         'class' => 'text-center',
        //     ],
        //     'filter' => [1 => 'Yes', 0 => 'No'],
        // ],
        //'is_active',
        //'auth_key',
        //'access_token',
        //'login_attempt',
        // 'created_date',
        //'updated_date',
        //'session_id',
        //'ip_address',
        //'password_delivery',

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Action',
            'headerOptions' => [
                'class' => 'text-center',
            ],
            'template' => '{activate}{update}',
            'contentOptions' => [
                'style' => 'white-space: nowrap; width: 100px',
            ],
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<i class="flaticon-edit"></i>', $url, [
                        'class' => 'btn btn-info m-btn m-btn--icon m-btn--icon-only m--margin-right-5',
                        'data-original-title' => 'View P2P',
                        'title' => 'Update user',
                        'data-toggle' => 'm-tooltip',
                    ]);
                },
                'activate' => function ($url, $model) {
                    // $to = $model->is_active == 1 ? ['warning', 'Deactivate', ''] : ['primary', 'Activate', 'min-width:68.723px'];
                    if ($model->login_attempt > 3 && $model->is_active == 1) {
                        $to = ['warning', 'Unblock', '<i class="la la-unlock-alt"></i>'];
                    } else if ($model->is_active == 1) {
                        $to = ['danger', 'Deactivate', '<i class="la la-power-off"></i>'];
                    } else {
                        $to = ['success', 'Activate', '<i class="la la-power-off"></i>'];
                    }
                    return Html::a($to[2], [($to[1] == 'Unblock' ? 'unblock' : 'switch-stat'), 'id' => $model->user_id], [
                        'class' => 'btn btn-' . $to[0] . ' m-btn m-btn--icon m-btn--icon-only m--margin-right-5 tooltips',
                        'data-original-title' => $to[1] . ' Customer',
                        'title' => $to[1],
                        'data-toggle' => 'm-tooltip',
                        'data' => [
                            'confirm' => 'Are you sure you want to ' . $to[1] . ' this Customer?',
                        ],
                    ]);
                },
            ],
        ],
    ],
]);?>
        </div>
    </div>
</div>
