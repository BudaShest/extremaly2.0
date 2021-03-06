<?php
/** @var yii\web\View $this */

/** @var Place $model */

use yii\widgets\DetailView;
use app\modules\admin\models\Place;
use yii\helpers\Html;

$this->title = 'Место ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        [
            'attribute' => 'description',
            'value' => function($data){
                return $data->description;
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'country_code',
            'value' => function ($data) {
                return Html::a($data->country->name  . '<br>' . Html::img($data->country->flag, ['class' => 'img-thumbnail']), ['country/view', 'code' => $data->country->code]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'climat_code',
            'value' => function ($data) {
                return Html::a($data->climat->name  . '<br>' . Html::img($data->climat->icon, ['class' => 'img-thumbnail']),  ['climat/view', 'code' => $data->climat->code]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'map',
            'value' => function ($data) {
                return "<script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?um={$data->map}&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true\"></script>";
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                $output = "";
                foreach ($data->images as $image) {
                    $output .= Html::img($image->image, ['class' => 'img-fluid']);
                }
                return $output;
            },
            'format' => 'html'
        ],
    ]
]) ?>

<div class="btn-group">
    <?= Html::a('Очистить файлы', ['/admin/place/delete-files', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>

