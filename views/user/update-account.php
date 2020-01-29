<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Account ';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/']];
$this->params['breadcrumbs'][] = $this->title;

$model->password = '';
?>

<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title"></div>
        </div>
        <div class="m-portlet__head-tools"></div>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'p2p_form',
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "<div class='form-group m-form__group row'>{label}<div class='col-lg-9'>{input}{error}</div></div>",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label'],
        ],
    ]); ?>
    <div class="m-portlet__body">        
        <div class="update-account-form">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'form-control m-input col-lg-8'])->label('Email Address') ?>
            
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'form-control m-input col-lg-8', 'disabled' => $model->is_ecoll == 1])->label('Username') ?>

            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control m-input col-lg-8', 'disabled' => $model->is_ecoll == 1]) ?>            
        </div>
        <div class="row">
            <div class="col-lg-3"><p> </p></div>
            <div class="col-lg-9">
                <div class="m-checkbox-list">
                    <?php if ($model->is_p2p == 1): ?>
                        <label class="m-checkbox m-checkbox--square m-checkbox--disabled">
                            <input type="checkbox" checked="checked" disabled="disabled">
                            Is User P2P
                            <span></span>
                        </label>
                    <?php endif; ?>

                    <?php if ($model->is_ecoll == 1): ?>
                        <label class="m-checkbox m-checkbox--square m-checkbox--disabled">
                            <input type="checkbox" checked="checked" disabled="disabled">
                            Is User Ecoll
                            <span></span>
                        </label>
                    <?php endif; ?>
                </div>
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
                <?= Html::submitButton('<span><i class="la la-check"></i><span>Save</span></span>',
                    ['class' => 'btn btn-success m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10'])
                ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>