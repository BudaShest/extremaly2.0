<?php
/** @var \yii\web\View $this */
/** @var Application $model */

use app\modules\admin\models\Application;
use yii\bootstrap4\ButtonDropdown;
use yii\helpers\Html;
use yii\widgets\DetailView;

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
<?= $this->render('/ticket/index', compact('dataProvider')) ?>
