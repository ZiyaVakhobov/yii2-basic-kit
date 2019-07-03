<?php

namespace app\src\admin\assets;

use dmstr\web\AdminLteAsset;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

class AdminAssets extends AssetBundle
{
    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        AdminLteAsset::class,
        JqueryAsset::class,
        BootstrapPluginAsset::class,
        FontAwesome::class,
    ];
}