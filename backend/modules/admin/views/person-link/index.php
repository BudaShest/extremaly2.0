<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$this->title = "Соц. сети личностей";
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Добавить соц. сети персон', ['person-link/create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $dataProvider->pagination,
    ],
    'columns' => [
        [
            'attribute' => 'title',
            'value' => function($data){
                return Html::a($data->title, ['person-link/view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'person_id',
            'value' => function($data){
                return $data->person->firstname . " " . $data->person->lastname;
            }
        ],
        [
            'attribute' => 'url',
        ],
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                return Html::img($data->icon, ['class' => 'img-thumbnail']);
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
                            ['label' => 'Обновить', 'url' => '/admin/person-link/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => '/admin/person-link/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
