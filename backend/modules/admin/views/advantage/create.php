<?php

/** @var \app\modules\admin\models\Advantage $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;

$this->title = 'Управление статичным контентов';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?=$this->title?></h3>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->input('text'); ?>
<?= $form->field($model, 'text')->widget(Redactor::class); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
