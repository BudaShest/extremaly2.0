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
                return Html::img('/uploads/' . $data->icon);
            },
            'format' => 'html'
        ]
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/climat/update', 'id' => $model->code], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/climat/delete', 'id' => $model->code], ['class' => 'btn btn-danger']) ?>
</div>
