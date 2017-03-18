<?php

use altiore\yii2\markdown\MarkdownEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model altiore\page\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(MarkdownEditor::className()) ?>

    <?= $form->field($model, 'position')->dropDownList($model::column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t($this->context->module->msgCategoryName, 'Create') : Yii::t($this->context->module->msgCategoryName, 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
