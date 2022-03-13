<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\Country $country */
/** @var \app\modules\admin\models\Climat $climat */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = "Места";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col">
        <h3>Страна</h3>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($country, 'code')->input('text'); ?>
            <?= $form->field($country, 'name')->input('text'); ?>
            <?= $form->field($country, 'uploads')->fileInput(); ?>
        <?php ActiveForm::end();?>
    </div>
    <div class="col">
        <h3>Климат</h3>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($climat, 'code')->input('text'); ?>
            <?= $form->field($climat, 'name')->input('text'); ?>
            <?= $form->field($climat, 'uploads')->fileInput(); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>