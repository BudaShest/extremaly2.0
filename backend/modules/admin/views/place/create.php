<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\Country $country */
/** @var \app\modules\admin\models\Climat $climat */

/** @var \app\modules\admin\models\Place $place */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = "Места";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col">
        <?= $this->render('/country/create', compact('country')) ?>
    </div>
    <div class="col">
        <?= $this->render('/climat/create', compact('climat')) ?>
    </div>
</div>
<div class="row">
    <div class="container">
        <h2>Добавить место</h2>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($place, 'name')->input('text') ?>
        <?= $form->field($place, 'address')->input('text') ?>
        <?= $form->field($place, 'description')->textarea() ?>
        <div class="form-group">
            <span><?= $place->getAttributeLabel('country_code') ?></span>
            <?= Html::activeDropDownList($place, 'country_code', ArrayHelper::map($country::find()->all(), 'code', 'name')) ?>
            <span><?= $place->getAttributeLabel('climat_code') ?></span>
            <?= Html::activeDropDownList($place, 'climat_code', ArrayHelper::map($climat::find()->all(), 'code', 'name')) ?>
        </div>
        <?= $form->field($place, 'uploads')->fileInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('Стереть', ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>