<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class AdminAssetBundle extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets';
    public $css = [
      'css/admin.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}