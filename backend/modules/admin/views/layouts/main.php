<?php
/** @var \yii\web\View $this */

/** @var string $content */

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use app\modules\admin\assets\AdminAssetBundle;
use yii\bootstrap4\Nav;

AdminAssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header">
    <?= Nav::widget([ //todo меню с дропдауном
        'items' => [
            [
                'label' => 'Места',
                'url' => '/admin/place'
            ],
            [
                'label' => 'Страны',
                'url' => '/admin/country'
            ],
            [
                'label' => 'Климат',
                'url' => '/admin/climat'
            ],
            [
                'label' => 'Персоны',
                'url' => '/admin/person'
            ],
            [
                'label' => 'Типы событий',
                'url' => '/admin/event-type'
            ],
            [
                'label' => 'События',
                'url' => '/admin/event'
            ],
            [
                'label' => 'Билеты',
                'url' => '/admin/ticket'
            ],
            [
                'label' => 'Заявки',
                'url' => '/admin/application'
            ],
            [
                'label' => 'Пользователи',
                'url' => '/admin/user'
            ],
            [
                'label' => 'Статический контент',
                'url' => '/admin/static-content'
            ],
            [
                'label' => 'Социальные сети персон',
                'url' => '/admin/person-link'
            ],
            [
                'label' => 'Социальные сети',
                'url' => '/admin/social-link'
            ],
            [
                'label' => 'О нас',
                'url' => '/admin/about'
            ],
            [
                'label' => 'Преимущества',
                'url' => '/admin/advantage'
            ],
        ]
    ]) ?>
    <?php if(!Yii::$app->user->isGuest):?>
    <?= Html::a('Выйти', ['main/logout'], ['class' => 'btn btn-danger']) ?>
    <?php endif ;?>
</header>
<main class="main">
    <div class="container">
        <?php echo Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]); ?>
        <?= $content ?>
    </div>
</main>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul>
                    <li>Версия: <?= Yii::$app->version ?> stable</li>
                    <li>Окружение: <?= YII_ENV == 'dev' ? '<b>тестовое</b>' : '<b>продуктивное</b>' ?></li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li>Разработал студент ЮУрГТк <a href="https://vk.com/kotanjam" target="_blank">Титов Александр</a>
                    </li>
                    <li><i>from <b>Russia</b> with <b>big</b> love!</i></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
