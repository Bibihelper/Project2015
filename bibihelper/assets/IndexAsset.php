<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/slider.css',
        'css/card.css',
        'css/index.css',
    ];
    public $js = [
        'js/slider.js',
        'js/card.js',
        'js/index.js',
    ];
    public $depends = [
        'app\assets\MainAsset',
    ];
}
