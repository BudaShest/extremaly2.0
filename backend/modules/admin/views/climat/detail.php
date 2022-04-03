<?php
/** @var yii\web\View $this */

/** @var \app\modules\admin\models\Climat $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Климат ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'code',
        'name',
        [
            'label' => 'Иконка',
            'value' => function ($data) {
                return Html::img($data->icon, ['class' => 'img-fluid']);
            },
            'format' => 'html'
        ]
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Очистить файлы', ['/admin/climat/delete-files', 'code' => $model->code], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['/admin/climat/update', 'code' => $model->code], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/climat/delete', 'code' => $model->code], ['class' => 'btn btn-danger']) ?>
</div>
