<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;

$this->title = 'Вcе типы событий';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Создать тип событий', ['event-type/create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $eventTypesProvider,
    'columns' => [
        [
            'label' => 'Номер ',
            'value' => function($data){
                return Html::a($data->id, ['event-type/view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Название',
            'value' => function($data){
                return Html::a($data->name, ['event-type/view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                return Html::img('/uploads/' . $data->icon, ['class' => 'img-thumbnail']);
            },
            'format' => 'html'
        ],
        [
            'label' => 'Действия',
            'value' => function ($data) {
                return ButtonDropdown::widget([
                    'label' => 'Действия',
                    'dropdown' => [
                        'items' => [
                            ['label' => 'Обновить', 'url' => 'event-type/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => 'event-type/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
