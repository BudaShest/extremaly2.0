<?php
/** @var \yii\web\View $this */

/** @var \yii\data\BaseDataProvider $reviewsProvider */

use app\modules\admin\models\Review;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Вcе отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<?= $this->render('/partials/flashBadge') ?>
<?= GridView::widget([
    'dataProvider' => $reviewsProvider,
    'pager' => [
        'class' => LinkPager::class,
        'pagination' => $reviewsProvider->pagination,
    ],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'
        ],
        [
            'attribute' => 'user_id',
            'value' => function ($data) {
                /** @var Review $data */
                return Html::a($data->user->login, ['user/view', 'id' => $data->user->id]);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'text',
            'format' => 'raw'
        ],
        [
            'attribute' => 'created_at'
        ],
        [
            'label' => 'Действия',
            'value' => function ($data) {
                /** @var Review $data */
                return ButtonDropdown::widget([
                    'label' => 'Действия',
                    'dropdown' => [
                        'items' => [
                            ['label' => 'Обновить', 'url' => '/admin/review/update?id=' . $data->id],
                            ['label' => 'Удалить', 'url' => '/admin/review/delete?id=' . $data->id],
                        ],
                    ],
                ]);
            },
            'format' => 'raw'
        ]
    ]
]) ?>
