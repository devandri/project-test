<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\widgets\ActiveForm;
use mdm\admin\components\RouteRule;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Json;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
?>

<div class="auth-item-form">
    <?php $form = ActiveForm::begin(['id' => 'item-form']); ?>
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title"></div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="m-portlet__head-title"></div>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'ruleName')->textInput(['id' => 'rule_name']) ?>

                <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot">
        <div class="row align-items-center">
            <div class="col-lg-12 m--valign-middle">
                <?= Html::a(
                    '<span><i class="la la-arrow-left"></i><span>Back</span></span>',
                    Yii::$app->request->referrer, ['class' => 'btn btn-danger m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10']);
                ?>
                <?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
                    'class' => $model->isNewRecord ? 'btn btn-success m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10' : 'btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10',
                    'name' => 'submit-button'])
                ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>