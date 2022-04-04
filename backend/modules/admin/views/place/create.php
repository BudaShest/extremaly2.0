<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\Country $country */
/** @var \app\modules\admin\models\Climat $climat */

/** @var \app\modules\admin\models\Place $place */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Country;
use app\modules\admin\models\Climat;
use yii\redactor\widgets\Redactor;

$this->title = "Места/страны/климат";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col">
        <?= $this->render('/country/create', ['country' => new Country()]) ?>
    </div>
    <div class="col">
        <?= $this->render('/climat/create', ['climat' => new Climat()]) ?>
    </div>
</div>
<div class="row">
    <div class="container">
        <h2>Добавить место</h2>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($place, 'name')->input('text') ?>
        <?= $form->field($place, 'address')->input('text') ?>
        <?= $form->field($place, 'description')->widget(Redactor::class) ?>
        <div class="form-group">
            <span><?= $place->getAttributeLabel('country_code') ?></span>
            <?= Html::activeDropDownList($place, 'country_code', ArrayHelper::map(Country::find()->all(), 'code', 'name')) ?>
            <span><?= $place->getAttributeLabel('climat_code') ?></span>
            <?= Html::activeDropDownList($place, 'climat_code', ArrayHelper::map(Climat::find()->all(), 'code', 'name')) ?>
        </div>
        <?= $form->field($place, 'uploads')->fileInput()?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('Стереть', ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
