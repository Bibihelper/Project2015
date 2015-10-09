<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\assets\AboutAsset;

AboutAsset::register($this);

$this->title = 'BibiHelper: О проекте';
$this->params['page'] = 'about';
$this->params['user'] = $user;
$this->params['company'] = $user->company;

?>

<?= $this->render('//dialogs.php', [
        'regFrm' => $regFrm,
        'logFrm' => $logFrm,
        'rstFrm' => $rstFrm,
    ]);
?>

<div class="container-fluid back-to-search">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="back-to-search-block">
                    <button type="button" class="btn f-button f-submit back-to-search-button">Вернуться к поиску</button>
                </div>
            </div>
        </div>       
    </div>
</div>

<div class="container-fluid about">
    <div class="row">
        <div class="container">
            <div class="row about-row">
                <div class="about-r">
                    <div class="about-title">
                        <span>Что такое BibiHelper ?</span>
                    </div>

                    <ul class="about-descr">
                        <li class="about-descr-item">
                            <span>
                                <span class="about-d">BibiHelper</span>
                                - независимый автомобильный IT-проект, который объединил в централизованную систему поиска десятки компаний по ремонту и обслуживанию автомобилей.
                            </span>
                        </li>

                        <li class="about-descr-item">
                            <span>Наша задача – предоставить своим пользователям необходимую информацию для оперативного и комфортного поиска выгодных предложений тех. центров именно для своего автомобиля.</span>
                        </li>

                        <li class="about-descr-item">
                            <span>
                                <span class="about-d">BibiHelper</span>
                                не является доской объявлений, это информационно – аналитическая система для решения всего спектра задач, связанных со срочным и плановым обслуживанием автомобиля.
                            </span>
                        </li>
                    </ul>

                    <div class="about-title">
                        <span>В чем преимущества BibiHelper ?</span>
                    </div>
                    
                    <ul class="about-list">
                        <li class="about-list-item">
                            <img src="<?= Url::to('/images/about-loupe.png') ?>" alt="">
                            <span>Удобный поиск среди сотен компаний в рамках одного сайта</span>
                        </li>
                        <li class="about-list-item">
                            <img src="<?= Url::to('/images/about-tools.png') ?>" alt="">
                            <span>Обслуживание своего автомобиля во всех компаниях через единый личный кабинет</span>
                        </li>
                        <li class="about-list-item">
                            <img src="<?= Url::to('/images/about-button.png') ?>" alt="">
                            <span>Хранение истории ремонта и ранее просмотренных предложений</span>
                        </li>
                        <li class="about-list-item">
                            <img src="<?= Url::to('/images/about-table.png') ?>" alt="">
                            <span>Сравнение цен на услуги по ремонту автомобиля</span>
                        </li>
                        <li class="about-list-item">
                            <img src="<?= Url::to('/images/about-check.png') ?>" alt="">
                            <span>Онлайн запись в автосервис и получение консультации от экспертов</span>
                        </li>
                        <li class="about-list-item">
                            <img src="<?= Url::to('/images/about-i.png') ?>" alt="">
                            <span>Уведомление об акциях и скидках от компаний-партнеров</span>
                        </li>
                    </ul>
                </div>

                <div class="about-loupe-world"></div>
                <div class="about-clock-car"></div>
            </div>
        </div>
    </div>
</div>

