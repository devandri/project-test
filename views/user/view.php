<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <!-- <h1><?=Html::encode($this->title);?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'email:email',
            'username',
            'password:ntext',
            'p2p_id:ntext',
            'is_active',
            'auth_key',
            'access_token',
            'login_attempt',
            'created_date',
            'updated_date',
            'session_id',
            'ip_address',
            'password_delivery',
        ],
    ]) ?>

</div>
