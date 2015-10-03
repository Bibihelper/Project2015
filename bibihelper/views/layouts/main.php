<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
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
            <?php if ($this->params['page'] == 'index'): ?>
                <?php if (Yii::$app->user->isGuest): ?>
                    <div class="menu__item">
                        <a href="#" title="" data-toggle="modal" data-target="#user-login-form" id="pre">Войти в личный кабинет</a>
                    </div>
                <?php else: ?>
                    <div class="menu__item">
                        <a href="<?= Yii::$app->user->getReturnUrl() ?>" title="">Войти в личный кабинет</a>
                    </div>
                <?php endif ?>
                <div class="menu__item menu__item_mrg-r">
                    <a href="#" title="" data-toggle="modal" data-target="#user-register-form" id="reg">Добавить автосервис</a>
                </div>
                <div class="menu__item menu__item_mrg-r" style="display: none;">
                    <a href="#" title="" data-toggle="modal" data-target="#restore-psw" id="rst">Восстановить пароль</a>
                </div>
            <?php elseif ($this->params['page'] == 'private-room'): ?>
                <div class="menu__item">
                    <div style="color:white"><?= $this->params['company']['user']['email'] ?></div>
                </div>
            <?php endif ?>
            </div> <!-- /row -->
        </div> 
    </div> <!-- /row -->
</div>

<div class="container-fluid header2">
    <div class="row">
        <div class="container">                
            <div class="row">
                <a href="<?= Url::base(true) ?>" title="">
                    <div class="logo">
                        <p class="logo__bibi-helper logo__bibi_color logo__bibi_shift"><span>BiBi<span class="logo__bibi-helper logo__helper_color">Helper</span></span></p>
                        <p class="logo__slogan">Удобный выбор автосервиса</p>                        
                    </div>
                </a>
                
                <?php if ($this->params['page'] == 'index'): ?>
                    <div class="city">                                             
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle bibi-btn bibi-btn_city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="bibi-btn-text" id="city__btn" data-city-id="0">Мой город</span>
                                <span class="caret bibi-btn-caret"></span>
                            </button>
                            <ul class="dropdown-menu bibi-list bibi-list_city">
                                <li data-city-id="1" data-city-coords="{latitude: 55.75368981, longitude: 37.61855388}"><a href="#" title="">Москва</a></li>
                                <li data-city-id="2" data-city-coords="{latitude: 59.93291880, longitude: 30.31607890}"><a href="#" title="">Санкт-Питербург</a></li>
                                <li data-city-id="3" data-city-coords="{latitude: 55.01749779, longitude: 82.92943263}"><a href="#" title="">Новосибирск</a></li>
                                <li data-city-id="4" data-city-coords="{latitude: 58.52212461, longitude: 31.27240443}"><a href="#" title="">Новгород</a></li>
                                <li data-city-id="5" data-city-coords="{latitude: 43.12041367, longitude: 131.8851974}"><a href="#" title="">Владивосток</a></li>
                            </ul>
                        </div>                                                                                               
                    </div>
                <?php endif ?>
                
            </div> <!-- /row -->               
        </div>     
    </div> <!-- /row -->
</div>

<?= $content ?>

<div class="pre-footer"></div>

<div class="container-fluid footer">
    <div class="row">
        <div class="container">
            <div class="row">
                
                <div class="f-menu">
                    <div class="f-menu__col">
                        <span><a href="#" title="">Для автосервисов</a></span>
                        <span><a href="#" title="">Автовладельцам</a></span>
                    </div>
                    <div class="f-menu__col">
                        <span><a href="#" title="">О проекте</a></span>
                        <span><a href="#" title="">Обратная связь</a></span>                        
                    </div>
                </div>
                
                <div class="f-block">
                    <div class="f-block__social">
                        <script type="text/javascript" src="http://vk.com/js/api/share.js?92" charset="windows-1251"></script>
                        <script type="text/javascript"><!--
                            document.write(VK.Share.button(false,{type: "custom", text: "<img src=\"http://vk.com/images/share_32_eng.png\" width=\"32\" height=\"32\" />", eng: 1}));
                        --></script>
                    </div>
                    <div class="f-block__copyright">
                        <p><span class="copyright-sign">&nbsp;&nbsp;&nbsp;&nbsp;&copy;&nbsp;</span><span class="copyrighter">2015&nbsp;BiBiHelper</span></p>
                    </div>
                </div>
                
            </div> <!-- /row -->
        </div>    
    </div> <!-- /row -->
    <span class="version">v.0.1</span>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
