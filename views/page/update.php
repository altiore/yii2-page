<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model altiore\page\models\Page */

$this->title = Yii::t($this->context->module->msgCategoryName, 'Update {modelClass}: ', [
    'modelClass' => 'Page',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t($this->context->module->msgCategoryName, 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t($this->context->module->msgCategoryName, 'Update');
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
