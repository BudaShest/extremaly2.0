<?php

/** @var \app\modules\admin\models\PersonLink $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Person;

$this->title = 'Управление соц. сетями персон';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?=$this->title?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->input('text'); ?>
<?= $form->field($model, 'url')->input('text'); ?>
<span><?= $model->getAttributeLabel('person_id') ?></span>
<?= Html::activeDropDownList($model, 'person_id', ArrayHelper::map(Person::find()->all(), 'id','firstname')) ?>
<?= $form->field($model, 'uploads')->fileInput(); ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
