<?php
/** @var \yii\web\View $this */

/** @var Ticket $model */

use app\modules\admin\models\Ticket;
use yii\grid\GridView;
use yii\helpers\Html;
use app\modules\admin\models\Event;
use yii\bootstrap4\LinkPager;

$this->title = 'Все билеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<div>
    <?= Html::a('Добавить билеты', ['create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $dataProvider->pagination,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Событие',
            'value' => function ($data){
                $event = Event::findOne($data['event_id']);
                return Html::a($event->name, ['event/view', 'id'=>$event->id]);
            },
            'format' => 'raw'
        ],
        'privilege',
        [
            'label' => 'Всего',
            'value' => function($data){

            }
        ],
        [
            'label' => 'Начало',
            'value' => function ($data){
                return $data->event->from;
            },
        ],
        [
            'label' => 'Конец',
            'value' => function ($data){
                return $data->event->until;
            },
        ],
//        [
//            'label' => 'В наличии',
//            'value' => function($data){
//                return $data->event->ticket_num - $bookedTicketsNum;
//            }
//        ],
        [
            'label' => 'Всего',
            'value' => function($data){
                return $data->event->ticket_num;
            }
        ]
    ]
]) ?>

