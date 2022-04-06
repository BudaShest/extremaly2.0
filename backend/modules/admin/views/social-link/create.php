<?php

/** @var \app\models\SocialLink $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;

$this->title = 'Добавить соц. сети';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?=$this->title?></h3>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->input('text'); ?>
<?= $form->field($model, 'url')->input('text'); ?>
<?= $form->field($model, 'uploads')->fileInput(); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
