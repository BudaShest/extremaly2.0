<?php
/** @var yii\web\View $this */

/** @var Place $model */

use yii\grid\GridView;
use yii\bootstrap4\LinkPager;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Place;
use app\modules\admin\models\Country;
use app\modules\admin\models\Climat;
use yii\helpers\Html;
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

$this->title = "Места/страны/климат";
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>
<h2>Места</h2>
<?= $this->render('/partials/flashBadge') ?>
<div>
    <?= Html::a('Создать место', ['create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $placesProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $placesProvider->pagination,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'name',
            'value' => function($data){
                return Html::a($data->name, ['view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'description',
            'value' => function($data){
                return substr($data->description,0,256);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'country_code',
            'value' => function($data){
                return Html::a($data->country->name, ['country/view', 'code'=>$data->country->code]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'climat_code',
            'value' => function($data){
                return Html::a($data->climat->name, ['climat/view', 'code'=>$data->climat->code]);
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
                            ['label' => 'Обновить', 'url' => '/admin/place/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => '/admin/place/delete?id='.$data->id],
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
