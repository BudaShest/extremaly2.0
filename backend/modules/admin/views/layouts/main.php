<?php
/** @var \yii\web\View $this */
/** @var string $content */

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use app\modules\admin\assets\AdminAssetBundle;
use yii\bootstrap4\Nav;

AdminAssetBundle::register($this);
?>
<?php $this->beginPage()?>
<!doctype html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header">
<?= Nav::widget([
  'items' => [
      [
          'label' => 'Места',
          'url' => 'admin/place'
      ]
  ]
])?>
</header>
<main class="main">
    <div class="container">
        <?php echo Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]); ?>
        <?= $content ?>
    </div>
</main>
<footer class="footer"></footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage()?>
