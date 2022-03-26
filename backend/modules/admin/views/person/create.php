<?php
/** @var \yii\web\View $this */
/** @var Person $model */

use yii\widgets\ActiveForm;
use app\models\Person;
use yii\helpers\Html;
$this->title = "Добавить личность";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?=$this->title?></h1>
<?php $form = ActiveForm::begin([]) ?>
<?= $form->field($model, 'firstname') ?>
<?= $form->field($model, 'lastname') ?>
<?= $form->field($model, 'patronymic') ?>
<?= $form->field($model, 'age')->input('number') ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'profession') ?>
<?= $form->field($model, 'uploads')->fileInput() ?>
<div class="btn-block">
    <?= Html::submitButton('Отправить' , ['class' => 'btn btn-success']) ?>
    <?= Html::resetButton('Стереть' , ['class' => 'btn btn-danger']) ?>
</div>
<?php ActiveForm::end() ?>
