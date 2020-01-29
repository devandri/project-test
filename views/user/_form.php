<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$selected = Json::htmlEncode( 
   ( !is_array($model->p2p_id) && !empty($model->p2p_id) && $model->p2p_id != '') ? explode(';', $model->p2p_id) : [] 
);

$this->registerJs("var _opts = $selected;");
$this->registerJs($this->render('_form.js'));

$p2p = (!empty($p2p)) ? ArrayHelper::map($p2p, 'p2p_id', 'p2p_name') : [];
$display = ($model->is_p2p === 1) ? 'block' : 'none';
$model->password = '';
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'user-form',
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "<div class='form-group m-form__group row'>{label}<div class='col-lg-9'>{input}{error}</div></div>",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label'],
        ],
    ]); ?>

    <div class="m-portlet__head">
        <div class="m-portlet__head-wrapper">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-plus"></i>
                    </span>
                    <h3 class="m-portlet__head-text"><?=$this->title?></h3>
                </div>
            </div>
            <div class="m-portlet__head-tools"></div>
        </div>
    </div>
    <div class="m-portlet__body">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'form-control m-input col-lg-8']) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'form-control m-input col-lg-8', 'readonly' => $model->is_ecoll == 1]) ?>

        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control m-input col-lg-8', 'readonly' => $model->is_ecoll == 1]) ?>

        <?= $form->field($model, 'is_ecoll')->checkbox()->label(''); ?>

        <?= $form->field($model, 'is_p2p')->checkbox()->label(''); ?>

        <?= $form->field($model, 'p2p_id[]',
                [
                    'options' => [
                        'style' => 'display: ' . $display
                    ]
                ]
            )->dropDownList(
            $p2p, 
            [
                'prompt'   => '',
                'id'       => 'multiple-select',
                'multiple' => 'multiple'
            ]
        )->label('P2P(s)') ?>
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
