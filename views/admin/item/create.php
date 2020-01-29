<?php

// use yii\helpers\Html;
use app\components\HtmlHelpers as Html;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">
	<div class="m-portlet m-portlet--mobile" id="main_portlet">
		<?=
		$this->render('_form', [
		    'model' => $model,
		]);
		?>
	</div>
</div>