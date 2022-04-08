<?php
$this->title = 'Управление заявками';
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Status;
use yii\helpers\Html;
?>

<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?php $form = ActiveForm::begin() ?>
<span><?= $model->getAttributeLabel('status_id') ?></span>
<?= Html::activeDropDownList($model, 'status_id', ArrayHelper::map(Status::find()->all(), 'id', 'name')) ?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    <?= Html::resetButton('Стереть', ['class' => 'btn btn-danger']) ?>
</div>
<?php ActiveForm::end()?>
