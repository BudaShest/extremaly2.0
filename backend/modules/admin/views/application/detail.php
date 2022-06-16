<?php
/** @var View $this */
/** @var Application $model */
/** @var BaseDataProvider $dataProvider */

use app\modules\admin\models\Application;
use yii\bootstrap4\ButtonDropdown;
use yii\data\BaseDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

$inApplication = true;

$this->title = 'Заявка №' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'user_id',
            'value' => function ($data) {
                /** @var Application $data */
                return Html::a($data->user->login, ['user/view', 'id' => $data->user->id]) . '<br/>' . Html::img($data->user->avatar);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'ticket_id',
            'value' => function ($data) {
                /** @var Application $data */
                $output = '';
                foreach ($data->tickets as $ticket) {
                    $output .= Html::a($ticket->privilege, ['ticket/view', 'id' => $ticket->id]) . '<br/>';
                }
                return $output;
            },
            'format' => 'raw'
        ],
        'num',
        [
            'attribute' => 'status_id',
            'value' => function ($data) {
                /** @var Application $data */
                return $data->status->name;
            }
        ],
        'created_at',
        [
            'label' => 'Действия',
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
            'format' => 'raw'
        ]
    ]
])
?>
<h2>Билеты в заявке</h2>
<div class="row">
    <div class="col">
        <span class="ticket-application-table-header">Билет</span>
    </div>
    <div class="col">
        <span class="ticket-application-table-header">Кол-во</span>
    </div>
</div>
<?php foreach ($model->ticketApplications as $ticketApplication): ?>
<div class="row">
    <div class="col">
        <span class="ticket-application-table-filed"><?= Html::a($ticketApplication->ticket->event->name, ['/admin/event/view', 'id' => $ticketApplication->ticket->event->id]) ?></span>
    </div>
    <div class="col">
        <span class="ticket-application-table-filed"><?= $ticketApplication->num ?></span>
    </div>
</div>
<?php endforeach; ?>
