<?php
/** @var yii\web\View $this */
/** @var \app\models\PersonLink $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Соц. сеть личности';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',
        [
            'attribute' => 'person_id',
            'value' => function($data){
                return $data->person->firstname . " " . $data->person->lastname;
            }
        ],
        'url',
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
    <?= Html::a('Очистить файлы', ['/admin/person-link/delete-files', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['/admin/person-link/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/person-link/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
