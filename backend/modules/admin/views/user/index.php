<?php
/** @var \yii\web\View $this */
/** @var User $model */

/** @var ActiveDataProvider $dataProvider */

use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;

$this->title = 'Все пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'login',
        'email',
        'phone',
        'password',
        [
            'label' => 'Действия',
            'value' => function ($data) {
                return ButtonDropdown::widget([
                    'label' => 'Действия',
                    'dropdown' => [
                        'items' => [
                            ['label' => 'Обновить', 'url' => 'user/update?id=' . $data->id],
                            ['label' => 'Удалить', 'url' => 'user/delete?id=' . $data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]

    ]
]) ?>