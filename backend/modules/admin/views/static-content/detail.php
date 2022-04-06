<?php
/** @var yii\web\View $this */

/** @var \app\modules\admin\models\StaticContent $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Статический контент';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',
        ['attribute' => 'text', 'format' => 'raw'],
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
    <?= Html::a('Очистить файлы', ['/admin/static-content/delete-files', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['/admin/static-content/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/static-content/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
