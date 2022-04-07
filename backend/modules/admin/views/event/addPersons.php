<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Person;
?>
<?php $form = ActiveForm::begin()?>
<div class="form-group">
    <span>Прикрепить персон к событию</span>
    <?= Html::activeDropDownList($model, 'place_id', ArrayHelper::map(Person::find()->all(), 'id','firstname')) ?>
</div>
<?php ActiveForm::end();?>
