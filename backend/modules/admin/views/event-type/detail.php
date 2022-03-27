<?php
/** @var yii\web\View $this */

/** @var \app\modules\admin\models\EventType $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Тип событий ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'Номер ',
            'value' => function($data){
                return Html::a($data->id, ['event-type/view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        'name',
        [
            'label' => 'Иконка',
            'value' => function ($data) {
                return Html::img('/uploads/' . $data->icon, ['class'=> 'img-thumbnail']);
            },
            'format' => 'html'
        ]
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/event-type/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/event-type/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
