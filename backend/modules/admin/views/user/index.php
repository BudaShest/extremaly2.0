<?php
/** @var \yii\web\View $this */
/** @var User $model */

/** @var ActiveDataProvider $dataProvider */

use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\bootstrap4\ButtonDropdown;
use yii\helpers\Html;
use yii\bootstrap4\LinkPager;

$this->title = 'Все пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= $this->title ?></h1>
<?= $this->render('/partials/flashBadge') ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $dataProvider->pagination,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => $model->getAttributeLabel('login'),
            'value' => function($data){
                return Html::a($data->login,'user/view?id='.$data->id);
            },
            'format' => 'raw'
        ],
        'email',
        'phone',
        [
            'label' => $model->getAttributeLabel('role_id'),
            'value' => function($data){
                return $data->role->name;
            }
        ],
        'ip',
        [
            'label' =>  'В бане?',
            'value' => function($data){
                if($data->banned){
                    return "Да";
                }
                return "Нет";
            }
        ],
        [
            'label' => 'Действия',
            'value' => function ($data) {
                $actions = [
                    ['label' => 'Обновить', 'url' => '/admin/user/update?id=' . $data->id],
                    ['label' => 'Удалить', 'url' => '/admin/user/delete?id=' . $data->id],
                ];

                if($data->banned){
                    $actions[] = ['label' => 'Разбанить', 'url' => '/admin/user/unban?id=' . $data->id];
                }else{
                    $actions[] = ['label' => 'Забанить', 'url' => '/admin/user/ban?id=' . $data->id];
                }

                return ButtonDropdown::widget([
                    'label' => 'Действия',
                    'dropdown' => [
                        'items' => $actions
                    ],
                ]);
            },
            'format' => 'raw'
        ]

    ]
]) ?>