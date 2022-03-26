<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class AdminAssetBundle extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets';
    public $css = [
        'css/admin.css',
        'css/expandForms.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
    ];
    public $js = [
        'js/expandForms.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}