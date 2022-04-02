<?php
/** @var \yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;

$this->title = 'Весь климат';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= Html::a('Создать климат', ['climat/create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $climatesProvider,
    'columns' => [
        [
            'label' => 'Код',
            'value' => function($data){
                return Html::a($data->code, ['climat/view', 'code'=>$data->code]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Название',
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
                            ['label' => 'Обновить', 'url' => 'climat/update?code='.$data->code],
                            ['label' => 'Удалить', 'url' => 'climat/delete?code='.$data->code],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
