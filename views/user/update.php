<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update User';
?>
<div class="user-update">
	<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
		<?= $this->render('_form', [
	        'model' => $model,
	        'p2p'	=> $p2p
	    ]) ?>
	</div>
</div>