<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Person;
?>
<?php $form = ActiveForm::begin()?>
<h3>Прикрепить личностей к событию</h3>
<div class="form-group">
    <span>Прикрепить персон к событию</span>
    <?= Html::activeDropDownList($model, 'place_id[]', ArrayHelper::map(Person::find()->all(), 'id','firstname'),['multiple'=>true]) ?>
    <div class="btn-block">
        <?= Html::submitButton('Отправить' , ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton('Стереть' , ['class' => 'btn btn-danger']) ?>
    </div>
</div>
<?php ActiveForm::end();?>
