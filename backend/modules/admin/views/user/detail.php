<?php
/** @var \yii\web\View $this */
/** @var User $model */
/** @var ActiveDataProvider $dataProvider */

use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Пользователь ' . $model->login;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'login',
        'email',
        'phone',
        [
            'label' => $model->getAttributeLabel('role_id'),
            'value' => function($data){
                return $data->role->name;
            }
        ]
    ]
]) ?>
<div class="row">
    <div class="col">
        <?= $this->render('/application/index', compact('applicationProvider')) ?>
    </div>
    <div class="col"></div>
</div>
