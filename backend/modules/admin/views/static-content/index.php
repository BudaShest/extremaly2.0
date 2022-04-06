<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$this->title = "Статический контент";
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Добавить статический контент', ['static-content/create'], ['class' => 'btn btn-success']) ?>
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
                return Html::a($data->title, ['static-content/view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'text',
            'format' => 'raw'
        ],
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                return Html::img($data->image, ['class' => 'img-thumbnail']);
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
                            ['label' => 'Обновить', 'url' => '/admin/static-content/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => '/admin/static-content/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
