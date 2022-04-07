<?php
/** @var \yii\web\View $this */
/** @var Ticket $model */
/** @var Event $event */

use app\modules\admin\models\Ticket;
use app\modules\admin\models\Event;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Добавить билеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?php $form = ActiveForm::begin([]) ?>
<div class="form-group">
    <span><?= $model->getAttributeLabel('event_id') ?></span>
    <?= Html::activeDropDownList($model, 'event_id', ArrayHelper::map(Event::find()->all(), 'id', 'name')) ?>
</div>
<?= $form->field($model, 'price' )->input('number') ?>
<?= $form->field($model, 'privilege')?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    <?= Html::resetButton('Стереть', ['class' => 'btn btn-danger']) ?>
</div>
<?php ActiveForm::end() ?>

