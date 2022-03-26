<?php
/** @var \yii\web\View $this */

/** @var \app\modules\admin\models\Country $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Страна ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'code',
        'name',
        [
            'label' => 'Флаг',
            'value' => function ($data) {
                return Html::img('/uploads/' . $data->flag);
            },
            'format' => 'html',
        ]
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/country/update', 'code' => $model->code], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/country/delete', 'code' => $model->code], ['class' => 'btn btn-danger']) ?>
</div>

