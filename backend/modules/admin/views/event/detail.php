<?php
/** @var \yii\web\View $this */
/** @var Event $model */

use app\modules\admin\models\Event;
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Событие ' .  $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        [
            'attribute' => 'offer',
            'value' => function($data){
                return $data->offer;
            },
            'format' => 'raw',
        ],
        'from',
        'until',
        [
            'attribute' => 'description',
            'value' => function($data){
                return $data->description;
            },
            'format' => 'raw',
        ],
        'age_restrictions',
        'priority',
        'is_horizontal',
        [
            'label' => 'Место (Страна и климат)',
            'value' => function($data){
                $output = '';
                $output .= Html::a($data->place->name, ['/admin/place/view', 'id' => $data->place->id], ['class' => 'lead']);
                $output .= Html::a(Html::img($data->place->country->flag, ['class' => 'img-thumbnail']), ['/admin/country/view', 'code' => $data->place->country->code]);
                $output .= Html::a(Html::img($data->place->climat->icon, ['class' => 'img-thumbnail']), ['/admin/climat/view', 'code' => $data->place->climat->code,]);
                return $output;
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Тип',
            'value' => function($data){
                return Html::a($data->type->name, ['/admin/event-type/view', 'id' => $data->type->id]);
            },
            'format' => 'raw'
        ],
        'ticket_num',
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
    <?= Html::a('Очистить файлы', ['/admin/event/delete-files', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Привязать личности', ['/admin/event/add-persons', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Обновить', ['/admin/event/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/event/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
<?= $this->render('/person/index', compact('personsProvider')) ?>

