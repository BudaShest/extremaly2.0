<?php
/** @var \yii\web\View $this */

$this->title = 'Управление заявками';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\grid\GridView;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= GridView::widget([
    'dataProvider' => $applicationProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'user_id',
        'ticket_id',
        'num',
        'status_id'
    ]
])
?>