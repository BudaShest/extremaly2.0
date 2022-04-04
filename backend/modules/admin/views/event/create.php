<?php
/** @var \yii\web\View $this */
/** @var  Event $model*/
/** @var EventType $eventType */

use app\modules\admin\models\Event;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Place;
use app\modules\admin\models\EventType;
use yii\redactor\widgets\Redactor;

$this->title = 'Добавить событие';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'offer')->widget(Redactor::class) ?>
<?= $form->field($model, 'from')->input('date') ?>
<?= $form->field($model, 'until')->input('date') ?>
<?= $form->field($model, 'description')->widget(Redactor::class)?>
<?= $form->field($model, 'age_restrictions') ?>
<?= $form->field($model, 'priority')->input('number') ?>
<?= $form->field($model, 'is_horizontal')->checkbox() ?>
<?= $form->field($model, 'uploads')->fileInput() ?>
<div class="form-group">
    <span><?= $model->getAttributeLabel('place_id') ?></span>
    <?= Html::activeDropDownList($model, 'place_id', ArrayHelper::map(Place::find()->all(), 'id','name')) ?>
    <span><?= $model->getAttributeLabel('type_id') ?></span>
    <?= Html::activeDropDownList($model, 'type_id', ArrayHelper::map(EventType::find()->all(), 'id', 'name')) ?>
</div>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    <?= Html::resetButton('Стереть', ['class' => 'btn btn-danger']) ?>
</div>
<?php ActiveForm::end() ?>
<?= $this->render('/event-type/create', ['eventType' => new EventType()]); ?>
