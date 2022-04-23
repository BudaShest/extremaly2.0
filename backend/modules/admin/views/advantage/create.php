<?php

/** @var Advantage $model */

use app\modules\admin\models\Advantage;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;

$this->title = $model->isNewRecord ? 'Добавление преимущества' : 'Управление преимуществом';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'admin-form']]); ?>
<?= $form->field($model, 'title')->input('text'); ?>
<?= $form->field($model, 'text')->widget(Redactor::class); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
