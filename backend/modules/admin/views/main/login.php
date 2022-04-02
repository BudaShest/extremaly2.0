<?php
/** @var \yii\web\View $this */
/** @var \app\models\User $model*/

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
        'inputOptions' => ['class' => 'col-lg-3 form-control'],
        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
    ],
]); ?>

<?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <div class="offset-lg-1 col-lg-11">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>
<?php ActiveForm::end();?>
