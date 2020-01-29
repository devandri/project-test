<?php
// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Login';
?>
    <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
                <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                    <div class="m-stack m-stack--hor m-stack--desktop">
                        <div class="m-stack__item m-stack__item--fluid">
                            <div class="m-login__wrapper">
                                <div class="m-login__logo">
                                    <a href="/"><img alt="" src="/temp/media/img/logo/icon.png" style="max-width:95px" /></a>
                                </div>
                                <div class="m-login__signin">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">Sign In To P2P Lender</h3>
                                    </div>
                                    <?php $form = ActiveForm::begin([
                                        'options' => [
                                                'class' => 'm-login__form m-form',
                                            ],
                                        'action' => ['site/login'],
                                        'enableClientValidation' => true
                                        ]); ?>

                                        <?= $form->field($model, 'username', ['template' => '<div class="form-group m-form__group">
                                            {input}{error}{hint} </div>',])->textInput([
                                            'autofocus' => true,
                                            'class' => 'form-control placeholder-no-fix',
                                            'placeholder' => 'Username',
                                            'autocomplete' => 'off',
                                        ]) ?>

                                        <?= $form->field($model, 'password', ['errorOptions' => ['encode' => false], 'template' => '<div class="form-group m-form__group">
                                        {input}{error}{hint} </div>',])->passwordInput([
                                            'class' => 'form-control placeholder-no-fix',
                                            'placeholder' => 'Password',
                                            'autocomplete' => 'off',
                                        ]) ?>

                                        <div class="row m-login__form-sub">
                                            <?= $form->field($model, 'rememberMe')->checkbox([
                                                'template' => '<div class="col m--align-left m-login__form-left">
                                                    <label class="m-checkbox  m-checkbox--focus">
                                                        {input}
                                                        Remember me
                                                        <span></span>
                                                    </label>
                                                </div>{error}',
                                            ]) ?>
                                            <!-- <div class="col m--align-right m-login__form-right">
                                                <a href="#forgot-password" id="m_login_forget_password" class="m-link" data-toggle="modal">
                                                    Forget Password ?
                                                </a>
                                            </div> -->
                                        </div>
                                        <div class="m-login__form-action">
                                            <?= Html::submitButton('Login', ['class' => 'btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary login-btn']) ?>
                                        </div>

                                    <?php ActiveForm::end(); ?>
                                </div>
                                <!-- <div class="m-login__signup">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Sign Up
                                        </h3>
                                        <div class="m-login__desc">
                                            Enter your details to create your account:
                                        </div>
                                    </div>
                                    <form class="m-login__form m-form" action="">
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="password" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                                        </div>
                                        <div class="row form-group m-form__group m-login__form-sub">
                                            <div class="col m--align-left">
                                                <label class="m-checkbox m-checkbox--focus">
                                                    <input type="checkbox" name="agree">
                                                    I Agree the
                                                    <a href="#" class="m-link m-link--focus">
                                                        terms and conditions
                                                    </a>
                                                    .
                                                    <span></span>
                                                </label>
                                                <span class="m-form__help"></span>
                                            </div>
                                        </div>
                                        <div class="m-login__form-action">
                                            <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Sign Up
                                            </button>
                                            <button id="m_login_signup_cancel" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div> -->
                                <!-- <div class="m-login__forget-password">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Forgotten Password ?
                                        </h3>
                                        <div class="m-login__desc">
                                            Enter your email to reset your password:
                                        </div>
                                    </div>
                                    <form class="m-login__form m-form" action="">
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                                        </div>
                                        <div class="m-login__form-action">
                                            <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Request
                                            </button>
                                            <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="m-stack__item m-stack__item--center">
                            <div class="m-login__account">
                                <span class="m-login__account-msg">Don't have an account yet ?</span>
                                &nbsp;&nbsp;
                                <a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">Sign Up</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content" style="background-image: url(/temp/media/img/bg/bg-4.jpg)">
                    <div class="m-grid__item m-grid__item--middle">
                        <h3 class="m-login__welcome">
                            P2P RDL Switching
                        </h3>
                        <p class="m-login__msg">
                            P2P Rekening Dana Lender Switching
                            <br>
                            See your money flows.
                        </p>
                    </div>
                </div>
            </div>
        </div>