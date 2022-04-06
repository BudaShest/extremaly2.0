<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$this->title = "О нас";
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Создать запись "О нас"', ['about/create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $dataProvider->pagination,
    ],
    'columns' => [
//        [
//            'attribute' => 'title',
//            'value' => function($data){
//                return Html::a($data->title, ['static-content/view', 'code'=>$data->id]);
//            },
//            'format' => 'raw'
//        ],
        ['attribute' => 'text', 'format' => 'raw'],
        ['attribute' => 'small_text', 'format' => 'raw'],
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
                            ['label' => 'Обновить', 'url' => '/admin/about/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => '/admin/about/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
