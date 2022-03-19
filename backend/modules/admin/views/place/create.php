<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\Country $country */
/** @var \app\modules\admin\models\Climat $climat */
/** @var \app\modules\admin\models\Place $place */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
//TODO сделать дополнительные формы DropDown-ом

$this->title = "Места";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col">
        <h3>Добавить страну</h3>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($country, 'code')->input('text'); ?>
            <?= $form->field($country, 'name')->input('text'); ?>
            <?= $form->field($country, 'uploads')->fileInput(); ?>
            <div class="form-group">
<!--                --><?//= Html::submitButton('Отправить', ['class'=>'btn btn-success']) ?>
            </div>
        <?php //ActiveForm::end();?>
    </div>
    <div class="col">
        <h3>Добавить климат</h3>
        <?php //$form = ActiveForm::begin(); ?>
            <?= $form->field($climat, 'code')->input('text'); ?>
            <?= $form->field($climat, 'name')->input('text'); ?>
            <?= $form->field($climat, 'uploads')->fileInput(); ?>
            <div class="form-group">
<!--                --><?//= Html::submitButton('Отправить', ['class'=>'btn btn-success']) ?>
            </div>
        <?php //ActiveForm::end(); ?>
    </div>
</div>
<div class="row">
    <div class="container">
        <h2>Добавить место</h2>
        <?php //$form = ActiveForm::begin();?>
            <?= $form->field($place, 'name')->input('text') ?>
            <?= $form->field($place, 'address')->input('text') ?>
            <?= $form->field($place, 'description')->textarea() ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class'=>'btn btn-success']) ?>
                <?= Html::resetButton('Стереть', ['class' => 'btn btn-danger']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>