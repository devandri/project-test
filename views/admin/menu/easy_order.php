<?php
// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
// use yii\grid\GridView;
// use yii\helpers\Url;
$js = <<<JS
   UINestable.init();
JS;
$this->registerJs($js);
$this->registerJsFile('@web/temp/plugins/jquery-nestable/jquery.nestable.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/temp/scripts/ui-nestable.js');
$this->registerCssFile("@web/temp/plugins/jquery-nestable/jquery.nestable.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerCss('
    .btn-success {
        background-color: #34bfa3;
        border-color: #34bfa3;
    }
    .btn-success:hover{
        background-color: #2ca189;
        border-color: #2ca189;
    }
');

$this->title = 'Easy Order Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['admin/menu/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="m-portlet m-portlet--mobile">
    <?= Html::beginForm(['admin-app/menu-easy-order'], 'post') ?>
    <?= Html::input('hidden', 'new_order', '', ['id' => 'nestable_menu_output']) ?>
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <?= Html::a('Add Menu', ['admin/menu/create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="m-portlet__head-title">
                <?= Html::submitButton('<i class="la la-check"></i> Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="dd" id="nestable_menu">
            <ol class="dd-list">
                <?php foreach ($menuItems as $menu) { ?>
                <li class="dd-item dd3-item" data-id="<?=$menu['id']?>">
                    <div class="dd-handle dd3-handle tooltips" data-original-title="Drag Menu" data-placement="left"></div>
                    <div class="dd3-content">
                        <?=$menu['label']?>
                         <div class="pull-right">
                             <?= Html::a(
                                '<i class="flaticon-edit-1"></i>',
                                ['admin/menu/update', 'id' => $menu['id']],
                                ['data-original-title' => 'Update Menu',
                                'class' => 'tooltips',]
                            ) ?>
                             <?= Html::a(
                                '<i class="flaticon-delete-1"></i>',
                                ['admin/menu/delete', 'id' => $menu['id']],
                                ['data-original-title' => 'Delete Menu',
                                    'class' => 'tooltips',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete menu?',
                                        'method' => 'post',
                                    ]
                                ]
                            ) ?>
                        </div>
                    </div>
                    <?php if (isset($menu['items'])) { ?>
                    <ol class="dd-list">
                    <?php foreach ($menu['items'] as $child) { ?>
                        <li class="dd-item dd3-item" data-id="<?=$child['id']?>">
                            <div class="dd-handle dd3-handle"></div>
                            <div class="dd3-content">
                                 <?=$child['label']?>
                                 <div class="pull-right">
                                     <?= Html::a(
                                        '<i class="flaticon-edit-1"></i>',
                                        ['admin/menu/update', 'id' => $child['id']],
                                        ['data-original-title' => 'Update Menu',
                                        'class' => 'tooltips',]
                                    ) ?>
                                     <?= Html::a(
                                        '<i class="flaticon-delete-1"></i>',
                                        ['admin/menu/delete', 'id' => $child['id']],
                                        ['data-original-title' => 'Delete Menu',
                                            'class' => 'tooltips',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete menu?',
                                                'method' => 'post',
                                            ]
                                        ]
                                    ) ?>
                                 </div>
                            </div>
                        </li>
                    <?php } ?>
                    </ol>
                    <?php } ?>
                </li>
                <?php } ?>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- <h3>JSON Order Output</h3> -->
                <!-- <div class="btn-group pull-right margin-top-10">
                    <?= Html::submitButton('<i class="flaticon-paper-plane"></i> Save', ['class' => 'btn btn-primary']) ?>
                </div> -->
                <!-- <pre rows="12" id="nestable_menu_output2"></pre> -->
            </div>
        </div>        
    </div>
    <?= Html::endForm() ?>
</div>