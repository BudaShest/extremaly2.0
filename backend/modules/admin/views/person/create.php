<?php
/** @var View $this */

/** @var Person $model */

use yii\widgets\ActiveForm;
use app\models\Person;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;
use yii\web\View;

$avatar = $model->images[0]["image"] ?? '';

$this->title = $model->isNewRecord ? "Добавить личность" : "Управление личностью: \"" . $model->firstname . " " . $model->lastname . "\"";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'admin-form']]) ?>
<?= $form->field($model, 'firstname') ?>
<?= $form->field($model, 'lastname') ?>
<?= $form->field($model, 'patronymic') ?>
<?= $form->field($model, 'age')->input('number') ?>
<?= $form->field($model, 'description')->widget(Redactor::class) ?>
<?= $form->field($model, 'role') ?>
<?php if (!$model->isNewRecord): ?>
    <div class="old-image">
        <header class="old-image-header">Текущий аватар:</header>
        <img src="<?= $avatar ?>" class="img-fluid" alt="">
    </div>
<?php endif; ?>
<?= $form->field($model, 'uploads')->fileInput() ?>
<div class="btn-block">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    <?= Html::resetButton('Стереть', ['class' => 'btn btn-danger']) ?>
</div>
<?php ActiveForm::end() ?>
