<?php

/** @var \app\modules\admin\models\About $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?=$this->title?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'text')->widget(Redactor::class); ?>
<?= $form->field($model, 'small_text')->widget(Redactor::class); ?>
<?= $form->field($model, 'uploads')->fileInput(); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
