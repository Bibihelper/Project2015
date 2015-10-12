<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Удобный выбор автосервиса'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'автосервис, автомойка, шиномонтаж'
]);

$this->registerMetaTag([
    'http-equiv' => 'X-UA-Compatible',
    'content' => 'IE=edge'
]);

$this->registerMetaTag([
    'name' => 'yandex-verification',
    'content' => '544d159be3f4a791'
]);

$city = $this->params['city'];

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter32958359 = new Ya.Metrika({
                        id:32958359,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        trackHash:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <!-- /Yandex.Metrika counter -->

</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid header1">
    <div class="row">
        <div class="container">
            <div class="row menu">
                <?php if ($this->params['page'] == 'index' || $this->params['page'] == 'specialoffers' || $this->params['page'] == 'about'): ?>
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
                                <?php foreach ($city as $c): ?>
                                    <li data-city-id="<?= $c->id ?>"
                                            data-city-coords="{latitude: <?= $c->latitude ?>, longitude: <?= $c->longitude ?>}">
                                        <a href="#" title=""><?= $c->name ?></a>
                                    </li>
                                <?php endforeach ?>
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
                        <span><a href="<?= Url::to('/about/') ?>" title="">О проекте</a></span>
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
                
                <noscript><div><img src="https://mc.yandex.ru/watch/32958359" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                
            </div>
        </div>    
    </div>
    <span class="version">v.0.1</span>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
