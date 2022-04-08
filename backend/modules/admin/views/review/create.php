<?php

/** @var \app\modules\admin\models\Review $review */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Управление отзывом';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 data-target="expandFormClimat" class="expand-toggler hoverable"><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'expand-form', 'id' => 'expandFormClimat', 'enctype' => 'multipart/form-data']]); ?>
<?= $form->field($review, 'text')->widget(\yii\redactor\widgets\Redactor::class) ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
