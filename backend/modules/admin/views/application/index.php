<?php
/** @var \yii\web\View $this */

$this->title = 'Управление заявками';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\LinkPager;
use yii\bootstrap4\ButtonDropdown;

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
            'value' => function ($data) {
                return Html::a($data->user->login, ['user/view', 'id' => $data->user->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'ticket_id',
            'value' => function ($data) {
//            var_dump($data->tickets);die;
                $output = '';
                foreach ($data->tickets as $ticket) {
                    $output .= Html::a($ticket->privilege, ['ticket/view','id'=>$ticket->id]) . '<br/>';
                }
                return $output;
            },
            'format' => 'raw'
        ],
        'num',
        [
            'attribute' => 'status_id',
            'value' => function ($data) {
                return $data->status->name;
            }
        ],
[        'label' => 'Действия',
        'value' => function ($data) {
            return ButtonDropdown::widget([
                'label' => 'Действия',
                'dropdown' => [
                    'items' => [
                        ['label' => 'Обновить', 'url' => '/admin/application/update?id=' . $data->id],
                        ['label' => 'Удалить', 'url' => '/admin/application/delete?id=' . $data->id],
                    ],
                ],
            ]);
        },
        'format' => 'raw']
    ]
]);
?>