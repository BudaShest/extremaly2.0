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
        'user_id',
        'ticket_id',
        'num',
        'status_id'
    ]
])
?>