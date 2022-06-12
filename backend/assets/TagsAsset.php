<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;


/**
 * Main backend application asset bundle.
 */
class TagsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/tagsinput';
    public $css = [
        'tagsinput.css',
    ];
    public $js = [
        'tagsinput.js'
    ];
    public $depends = [
        JqueryAsset::class
    ];
}