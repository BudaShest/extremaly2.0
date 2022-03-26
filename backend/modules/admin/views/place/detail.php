<?php
/** @var yii\web\View $this */
/** @var Place $model */

use yii\widgets\DetailView;
use app\modules\admin\models\Place;
use yii\helpers\Html;

$this->title = 'Место ' . $model->name;
?>

<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'description',
        'country_code',
        'climat_code',
//        'images',
    ]
])?>

<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/place/update', 'id' => $model->id, 'class' => 'btn']) ?>
    <?= Html::a('Удалить', ['/admin/place/delete', 'id' => $model->id, 'class' => 'btn']) ?>
</div>

