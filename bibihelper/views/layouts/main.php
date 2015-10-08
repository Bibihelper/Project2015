<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Удобный выбор автосервиса">
    <meta name="keywords" content="автосервис,автомойка,шиномонтаж">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid header1">
    <div class="row">
        <div class="container">
            <div class="row menu">
                <?php if ($this->params['page'] == 'index' || $this->params['page'] == 'specialoffers'): ?>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <div class="menu-item">
                            <a href="#" title="" data-toggle="modal" data-target="#user-login-form">Войти в личный кабинет</a>
                        </div>
                    <?php else: ?>
                        <div class="menu-item">
                            <a href="<?= '/private-room/?id=' . $this->params['company']['id'] ?>" title=""><?= $this->params['user']['email'] ?></a>
                        </div>
                    <?php endif ?>

                    <div class="menu-item menu-item-mr">
                        <a href="#" title="" data-toggle="modal" data-target="#user-register-form">Добавить автосервис</a>
                    </div>
                <?php elseif ($this->params['page'] == 'private-room'): ?>
                    <div class="menu-item">
                        <a href="<?= '/private-room/?id=' . $this->params['company']['id'] ?>" title=""><?= $this->params['user']['email'] ?></a>
                    </div>
                <?php endif ?>
            </div>
        </div> 
    </div>
</div>

<div class="container-fluid header2">
    <div class="row">
        <div class="container">                
            <div class="row">
                <a href="<?= Url::base(true) ?>" title="">
                    <div class="logo">
                        <p class="logo-bibi-helper logo-bibi-color logo-bibi-shift"><span>BiBi<span class="logo-bibi-helper logo-helper-color">Helper</span></span></p>
                        <p class="logo-slogan">Удобный выбор автосервиса</p>                        
                    </div>
                </a>
                
                <?php if ($this->params['page'] == 'index'): ?>
                    <div class="city">                                             
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle f-button city-button" id="city-button" data-city-id="0" data-toggle="dropdown">
                                <span class="f-button-caption">
                                    <span class="f-button-text">Мой город</span>
                                    <span class="caret f-button-caret"></span>
                                </span>
                            </button>
                            <ul class="dropdown-menu f-list city-list" id="city-list">
                                <li data-city-id="1" data-city-coords="{latitude: 55.75368981, longitude: 37.61855388}"><a href="#" title="">Москва</a></li>
                                <li data-city-id="2" data-city-coords="{latitude: 59.93291880, longitude: 30.31607890}"><a href="#" title="">Санкт-Питербург</a></li>
                                <li data-city-id="3" data-city-coords="{latitude: 55.01749779, longitude: 82.92943263}"><a href="#" title="">Новосибирск</a></li>
                                <li data-city-id="4" data-city-coords="{latitude: 58.52212461, longitude: 31.27240443}"><a href="#" title="">Новгород</a></li>
                                <li data-city-id="5" data-city-coords="{latitude: 43.12041367, longitude: 131.8851974}"><a href="#" title="">Владивосток</a></li>
                            </ul>
                        </div>                                                                                               
                    </div>
                <?php endif ?>
            </div>
        </div>     
    </div>
</div>

<?= $content ?>

<div class="pre-footer"></div>

<div class="container-fluid footer">
    <div class="row">
        <div class="container">
            <div class="row">
                
                <div class="footer-menu">
                    <div class="footer-menu-col">
                        <span><a href="#" title="">Для автосервисов</a></span>
                        <span><a href="#" title="">Автовладельцам</a></span>
                    </div>
                    <div class="footer-menu-col">
                        <span><a href="#" title="">О проекте</a></span>
                        <span><a href="#" title="">Обратная связь</a></span>                        
                    </div>
                </div>
                
                <div class="footer-block">
                    <div class="footer-block-social">
                        <script type="text/javascript" src="http://vk.com/js/api/share.js?92" charset="windows-1251"></script>
                        <script type="text/javascript"><!--
                            document.write(VK.Share.button(false,{type: "custom", text: "<img src=\"http://vk.com/images/share_32_eng.png\" width=\"32\" height=\"32\" />", eng: 1}));
                            VK.init({apiId: 5050952, onlyWidgets: true});
                            VK.Widgets.Like("vk_like", {type: "mini", height: 24});
                        --></script>
                    </div>
                    <div class="footer-block-copyright">
                        <p><span class="copyright-sign">&nbsp;&nbsp;&nbsp;&nbsp;&copy;&nbsp;</span><span class="copyrighter">2015&nbsp;BiBiHelper</span></p>
                    </div>
                </div>
                
            </div>
        </div>    
    </div>
    <span class="version">v.0.1</span>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
