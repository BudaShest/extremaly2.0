<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$this->title = "Места/страны/климат";
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>Климат</h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Создать климат', ['climat/create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $climatesProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $climatesProvider->pagination,
    ],
    'columns' => [
        [
            'attribute' => 'code',
            'value' => function($data){
                return Html::a($data->code, ['climat/view', 'code'=>$data->code]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'name',
            'value' => function($data){
                return Html::a($data->name, ['climat/view', 'code'=>$data->code]);
            },
            'format' => 'raw'
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
                            ['label' => 'Обновить', 'url' => '/admin/climat/update?code='.$data->code],
                            ['label' => 'Удалить', 'url' => '/admin/climat/delete?code='.$data->code],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
