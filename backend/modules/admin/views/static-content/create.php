<?php

/** @var \app\modules\admin\models\StaticContent $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;

$this->title = 'Управление статичным контентов';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?=$this->title?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'admin-form']]); ?>
<?= $form->field($model, 'title')->input('text'); ?>
<?= $form->field($model, 'text')->widget(Redactor::class); ?>
<?= $form->field($model, 'uploads')->fileInput(); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
