<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\Person $model */

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Создать персону';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'firstname',
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
                    $output .= Html::img('/uploads/' . $image->image, ['class' => 'img-thumbnail']);
                }
                return $output;
            },
            'format' => 'html'
        ],
    ]
]) ?>
<div class="btn-group">
    <?= Html::a('Обновить', ['/admin/person/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/person/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
