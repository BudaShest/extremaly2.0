<?php
/** @var yii\web\View $this */

/** @var \app\models\SocialLink $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Социальная сеть ' . $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',
        'url',
        [
            'label' => 'Картинки',
            'value' => function ($data) {
                return Html::img($data->icon, ['class' => 'img-fluid']);
            },
            'format' => 'html'
        ]
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Очистить файлы', ['/admin/social-link/delete-files', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['/admin/social-link/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/social-link/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
