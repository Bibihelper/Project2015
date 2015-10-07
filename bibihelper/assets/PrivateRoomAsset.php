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
class PrivateRoomAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/private-room.css',
    ];
    public $js = [
        'js/datepicker-ru.js',
        'js/private-room.js',
    ];
    public $depends = [
        'app\assets\MainAsset',
        'yii\jui\JuiAsset',
    ];
}
