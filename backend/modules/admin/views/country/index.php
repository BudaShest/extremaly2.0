<?php
/** @var \yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $countriesProvider */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;

$this->title = 'Добавить страну';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>Страны</h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Создать страну', ['country/create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $countriesProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $countriesProvider->pagination,
    ],
    'columns' => [
        [
            'label' => 'Код',
            'value' => function($data){
                return Html::a($data->code, ['country/view', 'code'=>$data->code]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Название',
            'value' => function($data){
                return Html::a($data->name, ['country/view', 'code'=>$data->code]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                return Html::img($data->flag, ['class' => 'img-thumbnail']);
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
                            ['label' => 'Обновить', 'url' => 'country/update?code='.$data->code],
                            ['label' => 'Удалить', 'url' => 'country/delete?code='.$data->code],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
