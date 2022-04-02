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
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
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
        <?= $this->render('/country/index', compact('countriesProvider')) ?>
    </div>
    <div class="col">
        <?= $this->render('/climat/index', compact('climatesProvider')) ?>
    </div>
</div>
