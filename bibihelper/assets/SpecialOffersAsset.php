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
class SpecialOffersAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/index.css',
        'css/card.css',
    ];
    public $js = [
        'js/index.js',
        'js/allspoff.js',
        'js/card.js',
    ];
    public $depends = [
        'app\assets\MainAsset',
    ];
}
