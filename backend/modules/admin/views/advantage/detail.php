<?php
/** @var yii\web\View $this */

/** @var \app\modules\admin\models\Advantage $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Преимущество № ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        ['attribute' => 'title', 'format' => 'raw'],
        ['attribute' => 'text', 'format' => 'raw'],
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/advantage/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/advantage/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
