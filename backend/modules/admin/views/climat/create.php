<?php

/** @var \app\modules\admin\models\Climat $climat */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Управление климатом';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 data-target="expandFormClimat" class="expand-toggler hoverable"><?=$this->title?></h3>
<?php $form = ActiveForm::begin(['options' => ['class' => 'expand-form', 'id' => 'expandFormClimat', 'enctype' => 'multipart/form-data']]); ?>
<?= $form->field($climat, 'code')->input('text'); ?>
<?= $form->field($climat, 'name')->input('text'); ?>
<?= $form->field($climat, 'uploads')->fileInput(); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
