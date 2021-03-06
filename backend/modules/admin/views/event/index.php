<?php
/** @var \yii\web\View $this */

/** @var Event $model */

use app\modules\admin\models\Event;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$dataProvider = new ActiveDataProvider([
    'query' => Event::find(),
    'pagination' => [
        'pageSize' => 10
    ]
]);

$this->title = 'Все события';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<div>
    <?= Html::a('Добавить событие', ['create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $dataProvider->pagination,
    ],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'
        ],
        [
            'attribute' => 'name',
            'value' => function ($data) {
                return Html::a($data->name, ['view', 'id' => $data->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'offer',
            'value' => function($data){
                return substr($data->offer,0,128) . '...';
            },
            'format' => 'raw',
        ],
        'from',
        'until',
        [
            'attribute' => 'place_id',
            'value' => function($data){
                return Html::a($data->place->name, ['place/view', 'id' => $data->place->id]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Тип',
            'value' => function($data){
                return Html::a($data->type->name, ['place/index', 'id' => $data->type->id]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                $output = "";
                foreach ($data->images as $image) {
                    $output .= Html::img($image->image, ['class' => 'img-thumbnail']);
                }
                return $output;
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
                            ['label' => 'Обновить', 'url' => '/admin/event/update?id=' . $data->id],
                            ['label' => 'Удалить', 'url' => '/admin/event/delete?id=' . $data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>

