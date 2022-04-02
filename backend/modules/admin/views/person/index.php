<?php
/** @var \yii\web\View $this */
/** @var Person $model */

use yii\bootstrap4\ButtonDropdown;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Person;
use yii\helpers\Html;

$dataProvider = new ActiveDataProvider([
    'query' => Person::find(),
    'pagination' => [
        'pageSize' => 10
    ]
]);

$this->title = 'Все персоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<div>
    <?= Html::a('Добавить персону', ['create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Имя',
            'value' => function($data){
                return Html::a($data->firstname, ['view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        'lastname',
        'patronymic',
        'age',
        'description',
        'profession',
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
                            ['label' => 'Обновить', 'url' => 'person/update?id='.$data->id],
                            ['label' => 'Удалить', 'url' => 'person/delete?id='.$data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>

