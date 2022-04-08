<?php
/** @var \yii\web\View $this */
/** @var Person $model */

use yii\bootstrap4\ButtonDropdown;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Person;
use yii\helpers\Html;
use yii\bootstrap4\LinkPager;


$this->title = 'Все персоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<div>
    <?= Html::a('Добавить персону', ['create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $personsProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $personsProvider->pagination,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'firstname',
            'value' => function($data){
                return Html::a($data->firstname, ['view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        'lastname',
        'patronymic',
        'age',
        'role',
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
                            ['label' => 'Обновить', 'url' => '/admin/person/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => '/admin/person/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>

