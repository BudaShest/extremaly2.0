<?php

/** @var \app\modules\admin\models\EventType $eventType */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавить тип события';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 data-target="expandFormClimat" class="expand-toggler hoverable"><?= $this->title ?></h3>
<?php $form = ActiveForm::begin(['options' => ['class' => 'expand-form', 'id' => 'expandFormClimat', 'enctype' => 'multipart/form-data']]); ?>
<?= $form->field($eventType, 'name')->input('text'); ?>
<?= $form->field($eventType, 'uploads')->fileInput(); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
