<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\Country $country */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Добавить страну';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 data-target="expandFormCountry" class="expand-toggler hoverable">Добавить страну</h3>
<?php $form = ActiveForm::begin(['options' => ['class' => 'expand-form', 'id' => 'expandFormCountry', 'enctype' => 'multipart/form-data']]); ?>
<?= $form->field($country, 'code')->input('text'); ?>
<?= $form->field($country, 'name')->input('text'); ?>
<?= $form->field($country, 'uploads')->fileInput(); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
