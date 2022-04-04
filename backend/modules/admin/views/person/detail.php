<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\Person $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Создать персону';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'firstname',
        'lastname',
        'patronymic',
        'age',
        [
            'attribute' => 'description',
            'value' => function($data){
                return $data->description;
            },
            'format' => 'raw'
        ],
        'profession',
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
    <?= Html::a('Очистить файлы', ['/admin/person/delete-files', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['/admin/person/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/person/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
