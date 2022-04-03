<?php
/** @var \yii\web\View $this */

$this->title = 'Управление заявками';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\LinkPager;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= GridView::widget([
    'dataProvider' => $applicationProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $applicationProvider->pagination,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'user_id',
            'value' => function($data){
                return Html::a($data->user->login, ['user/view', 'id' => $data->user->id]);
            }
        ],
        'ticket_id',
        'num',
        [
            'attribute' => 'status_id',
            'value' => function($data){
                return $data->status->name;
            }
        ]
    ]
]);
?>