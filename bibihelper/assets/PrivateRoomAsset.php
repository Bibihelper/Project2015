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
        'css/common.css',
        'css/private-room.css',
        'css/form.css',
    ];
    public $js = [
        'js/datepicker-ru.js',
        'js/private-room.js',
        'js/company-info.js',
        'js/user-options.js',
    ];
    public $depends = [
        'app\assets\ResetAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
        'app\assets\MapAsset',
    ];
}
