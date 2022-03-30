<?php
use Yii;

?>
<?php if(Yii::$app->session->hasFlash('success')): ?>
<div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
<?php elseif(Yii::$app->session->hasFlash('error')): ?>
<div class="alert alert-danger"><?= Yii::$app->session->getFlash('error') ?></div>
<?= Yii::$app->session->getFlash('error') ?>
<?php endif; ?>
