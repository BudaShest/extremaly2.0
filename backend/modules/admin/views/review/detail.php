<?php
/** @var yii\web\View $this */

/** @var \app\modules\admin\models\EventType $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Тип событий ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'Номер ',
            'value' => function($data){
                return Html::a($data->id, ['event-type/view', 'id'=>$data->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'user_id',
            'value' => function($data){
                return Html::a($data->user->login, ['user/view', 'id'=>$data->user->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'text',
            'format' => 'raw'
        ],
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/review/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/review/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
