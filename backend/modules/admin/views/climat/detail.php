<?php
/** @var yii\web\View $this */

/** @var \app\modules\admin\models\Climat $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Климат ' . $model->name
?>
<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'code',
        'name',
        [
            'label' => 'Иконка',
            'value' => function ($data) {
                return Html::img('/uploads/' . $data->icon);
            },
            'format' => 'html'
        ]
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/climat/update', 'id' => $model->code], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/climat/delete', 'id' => $model->code], ['class' => 'btn btn-danger']) ?>
</div>
