<?php
/** @var \yii\web\View $this */
/** @var User $model */
/** @var ActiveDataProvider $dataProvider */

use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
$this->title = 'Все пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title?></h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'login',
        'email',
        'phone',

    ]
]) ?>