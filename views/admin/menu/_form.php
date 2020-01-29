<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use mdm\admin\models\Menu;
use mdm\admin\models\Route;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */
$js = <<<JS
    if (jQuery().select2) {
        function format(flaticon) {
            return "<i class='" + flaticon.text.toLowerCase() + "'/>&nbsp;&nbsp;" + flaticon.text;
        }
        function formatli(flaticon) {
            return "&nbsp;&nbsp;<i style='padding-left:13px;' class='" + flaticon.text.toLowerCase() + "'/>" + flaticon.text;
        }
        $('#select2icon').select2({
            allowClear: true,
            formatResult: formatli,
            formatSelection: format,
            placeholder: 'Select an option',
            escapeMarkup: function (m) {
                return m;
            }
        });
        $('#multiple-select').select2({});
        $('#multiple-select').val(_opts.activeRoute).trigger('change');
    }
JS;
AutocompleteAsset::register($this);
$model->data = json_decode($model->data, true);
$icons       = Yii::$app->params['icons'];
$routes      = new Route();
$opts = Json::htmlEncode([
        'menus'       => Menu::getMenuSource(),
        'routes'      => Menu::getSavedRoutes(),
        'activeRoute' => isset($model->data['active_routes']) ? $model->data['active_routes'] : []
    ]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($js);
$this->registerJs($this->render('_script.js'));
// var_dump($icons); die();
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
                <?php if(!$model->isNewRecord): ?>
                    <?= Html::a(Yii::t('rbac-admin', 'Add Menu'), ['create'], ['class' => 'btn btn-success']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="menu-form">
            <?php 
            $form = ActiveForm::begin(['action' =>['/admin-app/menu?id='.$model->id]]);
            $checked = "";
            if(isset($model->data['hide'])) {
                $checked = $model->data['hide'] == 1 ? 'checked="checked"' : "";
            }

             ?>
            <?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

                    <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

                    <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>

                    <?= $form->field($model, 'order')->textInput() ?>
                </div>
                <div class="col-sm-6">
                    <!-- <?= $form->field($model, 'order')->input('number') ?> -->
                    <?= $form->field($model, 'data[icon]')->dropDownList($icons, ['prompt'=>'', 'id' => 'select2icon'])->label('Icon') ?>
                    <?= $form->field($model, 'data[active_routes][]')->dropDownList(
                        $routes->getAppRoutes(), 
                        [
                            'prompt'   =>'',
                            'id'       => 'multiple-select',
                            'multiple' => 'multiple'
                        ]
                    )->label('Active Route') ?>
                    <div class="form-group">
                        <label class="control-label" for="menu-data_hide">Hide</label>
                    </div>
                    <div class="form-group field-menu-data_hide has-success">
                        <input name="Menu[data][hide]" value="0" type="hidden">
                        <span class="m-switch m-switch--icon m-switch--success">
                            <label>
                                <input type="checkbox" <?= $checked; ?> id="menu-data_hide" name="Menu[data][hide]" value="1" aria-invalid="false">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?=
                Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord
                            ? 'btn btn-success' : 'btn btn-primary'])
                ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>