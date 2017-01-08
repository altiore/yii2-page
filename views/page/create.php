<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model altiore\page\models\Page */

$this->title = Yii::t($this->context->module->msgCategoryName, 'Create Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t($this->context->module->msgCategoryName, 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
