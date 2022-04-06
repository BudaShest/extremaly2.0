<?php
/** @var yii\web\View $this */

/** @var \app\models\About $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        ['attribute' => 'text', 'format' => 'raw'],
        ['attribute' => 'small_text', 'format' => 'raw'],
        [
            'label' => 'Картинки',
            'value' => function ($data) {
                return Html::img($data->image, ['class' => 'img-fluid']);
            },
            'format' => 'html'
        ]
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Очистить файлы', ['/admin/about/delete-files', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['/admin/about/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/about/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
