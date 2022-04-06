<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$this->title = "Соц сети";
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Добавить соц. сеть', ['social-link/create'], ['class' => 'btn btn-success']) ?>
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
                return Html::a($data->title, ['social-link/view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'url',
        ],
        [
            'label' => 'Иконка',
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
                            ['label' => 'Обновить', 'url' => '/admin/social-link/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => '/admin/social-link/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
