<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$this->title = 'Вcе отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= GridView::widget([
    'dataProvider' => $reviewsProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $reviewsProvider->pagination,
    ],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'
        ],
        [
            'attribute' => 'user_id',
            'value' => function($data){
                return Html::a($data->user->login, ['user/view', 'id'=>$data->user->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'text',
            'format' => 'raw'
        ],
        [
            'label' => 'Действия',
            'value' => function ($data) {
                return ButtonDropdown::widget([
                    'label' => 'Действия',
                    'dropdown' => [
                        'items' => [
                            ['label' => 'Обновить', 'url' => '/admin/review/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => '/admin/review/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
