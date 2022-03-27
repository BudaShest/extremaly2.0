<?php
/** @var \yii\web\View $this */
/** @var Event $model */

use app\modules\admin\models\Event;
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Событие ' .  $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'offer',
        'from',
        'until',
        'description',
        'age_restrictions',
        'priority',
        'is_horizontal',
        [
            'label' => 'Место',
            'value' => function($data){
                return Html::a($data->place->name, ['place/index', 'id' => $data->place->id]);
            },
            'format' => 'raw'
        ],
        [
            'label' => 'Тип',
            'value' => function($data){
                return Html::a($data->type->name, ['place/index', 'id' => $data->type->id]);
            },
            'format' => 'raw'
        ],
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
    <?= Html::a('Обновить', ['/admin/event/update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['/admin/event/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</div>
