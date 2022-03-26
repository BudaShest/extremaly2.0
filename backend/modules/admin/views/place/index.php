<?php
/** @var yii\web\View $this */

/** @var Place $model */

use yii\grid\GridView;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Place;
use app\modules\admin\models\Country;
use app\modules\admin\models\Climat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ButtonDropdown;

$placesProvider = new ActiveDataProvider([
    'query' => Place::find(),
    'pagination' => [
        'pageSize' => 10,
    ],
]);

$countriesProvider = new ActiveDataProvider([
    'query' => Country::find(),
    'pagination' => [
        'pageSize' => 10,
    ],
]);

$climatesProvider = new ActiveDataProvider([
    'query' => Climat::find(),
    'pagination' => [
        'pageSize' => 10,
    ],
]);

$this->title = "Все места";
?>

<h1><?= $this->title ?></h1>
<div>
    <?= Html::a('Создать место', ['create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $placesProvider,
//    'header' => Html::encode(Place::MODEL_NAME_RU_MULTI),
    'columns' => [
        [
            'label' => 'Название',
            'value' => function($data){
                return Html::a($data->name, ['view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        'description',
        'country_code',
        'climat_code',
        [
            'label' => 'Изображения',
            'value' => function ($data) {
                $output = "";
                foreach ($data->images as $image) {
                    $output .= Html::img('/uploads/' . $image->image, ['class' => 'img-thumbnail']);
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
                            ['label' => 'Обновить', 'url' => 'place/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => 'place/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]

    ],
]) ?>
<h2>Страны и климаты</h2>
<div class="row">
    <div class="col">
        <h3>Страны</h3>
        <?= GridView::widget([
            'dataProvider' => $countriesProvider,
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
                        return Html::img('/uploads/' . $data->flag, ['class' => 'img-thumbnail']);
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
    </div>
    <div class="col">
        <h3>Климаты</h3>
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
                                    ['label' => 'Обновить', 'url' => 'climat/update?code='.$data->code],
                                    ['label' => 'Удалить', 'url' => 'climat/create?code='.$data->code],
                                ],
                            ],
                        ]);
                    },
                    'format' => 'raw'
                ]
            ]
        ]) ?>
    </div>
</div>
