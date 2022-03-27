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
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'description',
        'country_code',
        'climat_code',
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                $output = "";
                foreach ($data->images as $image) {
                    $output .= Html::img('/uploads/' . $image->image, ['class' => 'img-thumbnail']);
                }
                return $output;
            },
            'format' => 'html'
        ],
    ]
])?>

<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/place/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/place/delete', 'id' => $model->id], ['class' => 'btn-danger']) ?>
</div>
