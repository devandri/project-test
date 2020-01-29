<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
	<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
		<?= $this->render('_form', [
        'model' => $model,
        'p2p'	=> $p2p
    ]) ?>
	</div>
</div>
