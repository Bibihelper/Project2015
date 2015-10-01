<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\IndexAsset;

IndexAsset::register($this);

$this->title = 'BibiHelper';
$this->params["page"] = "index";

?>

<div class="modal fade" id="user-login-form" tabindex="-1" role="dialog" aria-labelledby="modal-label-reg" aria-hidden="true">
    <div class="modal-dialog m-dialog">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'action' => Url::to('/user/login/'),
            'validationUrl' => Url::to('/index/validate-login-form/'),
            'successCssClass' => '',
        ]); ?>
            <div class="modal-content f-content rf-content">
                <button type="button" class="close f-close" data-dismiss="modal" aria-hidden="true" id="rf-close">&times;</button>

                <div class="modal-header f-header">
                    <h1 class="modal-title f-title">Вход в личный кабинет</h1>
                </div>

                <div class="modal-body f-body">
                    
                    <?= $form->field($logFrm, 'email', [
                            'options' => ['class' => 'form-group f-group']
                        ])->textInput([
                            'class' => 'form-control f-control'
                        ])->label($logFrm->getAttributeLabel('email'), [
                            'class' => 'f-label'
                        ])
                    ?>
                    
                    <?= $form->field($logFrm, 'password', [
                            'options' => ['class' => 'form-group f-group'],
                            'template' => "{label}\n"
                                . "<span class=\"f-icon f-icon-ok\"></span>"
                                . "<div class=\"input-group\">{input}"
                                    . "<span class=\"input-group-addon f-input-group-addon\">?</span>"
                                    . "<span class=\"f-hint f-hint-password\">Забыли пароль?</span>"
                                . "</div>\n{error}"
                        ])->passwordInput([
                            'class' => 'form-control f-control'
                        ])->label($logFrm->getAttributeLabel('password'), [
                            'class' => 'f-label'
                        ]) 
                    ?>
                    
                    <?= $form->field($logFrm, 'rememberme', [
                            'options' => ['class' => 'form-group f-group c-mb0'],
                            'checkboxTemplate' => "{input}\n{label}"
                        ])->checkbox([
                            'class' => 'f-checkbox'
                        ])->label($logFrm->getAttributeLabel('rememberme'), [
                            'class' => 'f-label'
                        ])
                    ?>
                    
                </div>
                
                <div class="modal-footer f-footer">
                    <div class="form-group f-group">
                        <?= Html::submitButton('Войти', ['class' => 'f-button f-submit', 'id' => 'lf-submit']) ?>
                    </div>

                    <div class="form-group f-group">
                        <span class="f-link" id="lf-register">Еще не зарегистрировались?</span>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div> 
    
<div class="modal fade" id="user-register-form" tabindex="-1" role="dialog" aria-labelledby="modal-label-reg" aria-hidden="true">
    <div class="modal-dialog m-dialog">
        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'enableAjaxValidation' => true,
            'action' => Url::to('/user/register/'),
            'validationUrl' => Url::to('/index/validate-register-form/'),
            'successCssClass' => '',
        ]); ?>
            <div class="modal-content f-content rf-content">
                <button type="button" class="close f-close" data-dismiss="modal" aria-hidden="true" id="rf-close">&times;</button>

                <div class="modal-header f-header">
                    <h1 class="modal-title f-title">Регистрация</h1>
                </div>

                <div class="modal-body f-body">
                    <?= $form->field($regFrm, 'email', [
                            'options' => ['class' => 'form-group f-group']
                        ])->textInput([
                            'class' => 'form-control f-control'
                        ])->label($regFrm->getAttributeLabel('email'), [
                            'class' => 'f-label'
                        ]) 
                    ?>

                    <?= $form->field($regFrm, 'password', [
                            'options' => ['class' => 'form-group f-group']
                        ])->passwordInput([
                            'class' => 'form-control f-control'
                        ])->label($regFrm->getAttributeLabel('password'), [
                            'class' => 'f-label'
                        ]) 
                    ?>

                    <?= $form->field($regFrm, 'passwordok', [
                            'options' => ['class' => 'form-group f-group c-mb0']
                        ])->passwordInput([
                            'class' => 'form-control f-control'
                        ])->label($regFrm->getAttributeLabel('password'), [
                            'class' => 'f-label'
                        ])
                    ?>
                </div>
                
                <div class="modal-footer f-footer">
                    <div class="form-group f-group">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'f-button f-submit', 'id' => 'rf-submit']) ?>
                    </div>

                    <div class="form-group f-group">
                        <span class="f-qtext">Уже зарегистрировались?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="f-link" id="rf-login">Войти</span>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div> 

<div class="modal fade" id="user-restorepsw-form" tabindex="-3" role="dialog" aria-labelledby="modal-label-restore-psw" aria-hidden="true">
    <div class="modal-dialog modal-dialog_dlg">
    
        <div class="modal-content modal-content_dlg">
        
            <div class="modal-header modal-header_dlg">
                <button type="button" class="close modal-header_close-btn" data-dismiss="modal" aria-hidden="true" id="restore-psw-close">&times;</button>
                <h1 class="modal-title modal-title_dlg">Восстановление пароля</h1>
            </div>
            
            <div class="modal-body modal-body_dlg">
                <form>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__caption">Адрес электронной почты:</span>
                        <div class="input-group">
                            <input type="text" class="form-control modal-dialog__edit" id="modal-dialog__edit_email-restore-psw">
                            <span id="modal-dialog__email-ok-restore-psw"></span>
                        </div>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__caption">
                            На указанный адрес электронной почты будет отправлено письмо<br>с новым паролем.<br>
                            Если письмо не пришло, проверьте папку "Спам" или повторите попытку.
                        </span>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <button type="button" class="btn bibi-form-btn bibi-form-btn-dlg bibi-form-btn-dlg_reg" id="restore-psw-btn">Восстановить</button>
                    </div>
                    
                </form>
            </div> <!-- /modal-body_dlg -->
            
        </div> <!-- /modal-content -->
        
    </div>
</div> <!-- /restore-psw -->

<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="aria-card">
    <div class="modal-dialog c-card">

        <div class="modal-content c-content">
            <div class="modal-header c-header">
            <button type="button" class="close c-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body c-body">
                <div class="c-col-1">
                    <div class="address">
                        <span class="a-title">Ультра-Сервис</span>
                        <span class="a-diller">Автосервис</span>
                        <span class="a-district">Центральный район</span>
                        <span class="a-address">ул. Ленина, д.3, к.1, стр. 2</span>
                        <span class="a-shedule">График работы: ежедневно <img src="images/twenty-four-hour.png" alt=""></span>
                        <span class="a-phone"><img src="images/a-phone.png" alt=""> +7 (985) 647-85-11</span>
                    </div>

                    <div class="info">
                        <span class="i-title">Обслуживаемые марки автомобилей</span>

                        <div class="i-block">
                            <span class="info-arrow info-arrow-up-na"></span>

                            <div class="i-block-list">
                                <ul class="icon-list" data-top="0">
                                    <li class="il-item"><img src="images/brand-icons/Mercedes.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/Fiat.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/Lotus.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/Lamborghini.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/Ferrari.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/MG.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/Lancia.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/BMW.png" alt=""></li>
                                    <li class="il-item"><img src="images/brand-icons/Hyundai.png" alt=""></li>
                                </ul>
                            </div>

                            <span class="info-arrow info-arrow-down"></span>
                        </div>
                    </div>

                    <div class="info">
                        <span class="i-title">Оказываемые услуги</span>

                        <div class="i-block">
                            <span class="info-arrow info-arrow-up-na"></span>

                            <div class="i-block-list i-block-list-m">
                                <ul class="cat-list" data-top="0">
                                    <li class="cl-item">
                                        <span class="cl-item-text">Техническое обслуживание:</span>

                                        <ul class="srv-list">
                                            <li class="sl-item">замена колодок</li>
                                            <li class="sl-item">плановое ТО</li>
                                            <li class="sl-item">экспресс замена жидкостей</li>
                                        </ul>
                                    </li>

                                    <li class="cl-item">
                                        <span class="cl-item-text">Кузовной ремонт и покраска:</span>

                                        <ul class="srv-list">
                                            <li class="sl-item">ремонт зеркал</li>
                                            <li class="sl-item">покраска</li>
                                            <li class="sl-item">полировка кузова</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <span class="info-arrow info-arrow-down"></span>
                        </div>
                    </div>
                </div>

                <div class="c-col-2">
                    <div id="address-map-id" class="address-map"></div>

                    <div class="special-offer">
                        <div class="so-title">
                            <span class="so-title-text">Специальное предложение</span>
                        </div>

                        <div class="so-info">
                            <div class="so-col-1">
                                <img src="images/slide-1.png" alt="" class="so-img">
                            </div>

                            <div class="so-col-2">
                                <span class="so-text">Скидка 20% на замену масла плюс мойка за пол цены!</span>
                                <span class="so-text so-period">С 1 августа по 1 сентября</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="c-footer"></div>
            </div>
        </div>

    </div>
</div>

<div class="container main">
    <div class="row">
        
        <div class="register-response">
            <span class="register-message"><?= $responseMessage ?></span>
        </div>
        
        <div id="map">
        <!--
            <img src="images/map.png">
        -->
        </div> <!-- /map -->
        
        <div class="search search_simple">
            <div class="search__headline"></div>
            
            <div class="search__form">
                <form>
                    
                    <div class="form__block">
                        <span class="form__caption">Марка</span>
                        <div class="btn-group">
                            <button type="button" class="form-control btn dropdown-toggle bibi-btn bibi-btn_search-form" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="bibi-btn-text" id="search_simple__brand" data-brand-id="0">&nbsp;</span>
                                <span class="caret bibi-btn-caret bibi-btn-caret_blue"></span>
                            </button>
                            <ul class="dropdown-menu bibi-list bibi-list_form" id="search_simple__brand-list">
                                <li data-brand-id="1"><a href="#" title="">Mersedes</a></li>
                                <li data-brand-id="2"><a href="#" title="">Audi</a></li>
                                <li data-brand-id="3"><a href="#" title="">BMW</a></li>
                                <li data-brand-id="4"><a href="#" title="">Toyota</a></li>
                                <li data-brand-id="5"><a href="#" title="">Jeep</a></li>
                            </ul>
                        </div>                                                                                               
                    </div>
                    
                    <div class="form__block">
                        <span class="form__caption">Вид работы</span>
                        <div class="btn-group">
                            <button type="button" class="form-control btn dropdown-toggle bibi-btn bibi-btn_search-form" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="bibi-btn-text" id="search_simple__w-type" data-w-type-id="0">&nbsp;</span>
                                <span class="caret bibi-btn-caret bibi-btn-caret_blue"></span>
                            </button>
                            <ul class="dropdown-menu bibi-list bibi-list_form" id="search_simple__w-type-list">
                                <li data-w-type-id="1"><a href="#" title="">Замена масла</a></li>
                                <li data-w-type-id="2"><a href="#" title="">Зарядка аккумулятора</a></li>
                                <li data-w-type-id="3"><a href="#" title="">Подкачка шин</a></li>
                                <li data-w-type-id="4"><a href="#" title="">Диагностика</a></li>
                            </ul>
                        </div>                                                                                                                               
                    </div>
                    
                    <div class="form__block">
                        <span class="form__caption">
                            <span class="form__caption_tw">Круглосуточно</span>
                            <span class="form__check" id="search_simple__tw-check"></span>
                            <input type="checkbox" class="form__cbx" id="search_simple__tw-cbx" checked="checked">
                        </span>
                    </div>
                    
                    <div class="form__block">
                        <a href="#" title="" class="form__ext-s-btn" id="ext-search-btn">Расширенный поиск</a>
                    </div>
                    
                    <div class="form__block">
                        <button type="button" class="btn bibi-form-btn bibi-form-btn_search">Подобрать</button>
                    </div>
                    
                </form>
            </div>
        </div> <!-- /search -->
        
        <div class="search search_ext" style="display: none;">
            <div class="search__headline"></div>
            
            <div class="search__form">
                <form>
                    
                    <div class="form__block">
                        <span class="form__caption">Марка</span>
                        <div class="btn-group">
                            <button type="button" class="form-control btn dropdown-toggle bibi-btn bibi-btn_search-form" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="bibi-btn-text" id="search_ext__brand" data-brand-id="0">&nbsp;</span>
                                <span class="caret bibi-btn-caret bibi-btn-caret_blue"></span>
                            </button>
                            <ul class="dropdown-menu bibi-list bibi-list_form" id="search_ext__brand-list">
                                <li data-brand-id="1"><a href="#" title="">Mersedes</a></li>
                                <li data-brand-id="2"><a href="#" title="">Audi</a></li>
                                <li data-brand-id="3"><a href="#" title="">BMW</a></li>
                                <li data-brand-id="4"><a href="#" title="">Toyota</a></li>
                                <li data-brand-id="5"><a href="#" title="">Jeep</a></li>
                            </ul>
                        </div>                                                                                               
                    </div>
                    
                    <div class="form__block">
                        <span class="form__caption">Вид работы</span>
                        <div class="btn-group">
                            <button type="button" class="form-control btn dropdown-toggle bibi-btn bibi-btn_search-form" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="bibi-btn-text" id="search_ext__w-type" data-w-type-id="0">&nbsp;</span>
                                <span class="caret bibi-btn-caret bibi-btn-caret_blue"></span>
                            </button>
                            <ul class="dropdown-menu bibi-list bibi-list_form" id="search_ext__w-type-list">
                                <li data-w-type-id="1"><a href="#" title="">Замена масла</a></li>
                                <li data-w-type-id="2"><a href="#" title="">Зарядка аккумулятора</a></li>
                                <li data-w-type-id="3"><a href="#" title="">Подкачка шин</a></li>
                                <li data-w-type-id="4"><a href="#" title="">Диагностика</a></li>
                            </ul>
                        </div>                                                                                                                               
                    </div>
                    
                    <div class="form__block">
                        <span class="form__caption">Район</span>
                        <div class="btn-group">
                            <button type="button" class="form-control btn dropdown-toggle bibi-btn bibi-btn_search-form" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="bibi-btn-text" id="search_ext__distr" data-distr-id="0">&nbsp;</span>
                                <span class="caret bibi-btn-caret bibi-btn-caret_blue"></span>
                            </button>
                            <ul class="dropdown-menu bibi-list bibi-list_form" id="search_ext__distr-list">
                                <li data-distr-id="1"><a href="#" title="">Октябрьский</a></li>
                                <li data-distr-id="2"><a href="#" title="">Ленинский</a></li>
                                <li data-distr-id="3"><a href="#" title="">Советский</a></li>
                            </ul>
                        </div>                                                                                                                               
                    </div>
                    
                    <div class="form__block">
                        <span class="form__caption">Названиее автосервиса</span>
                        <div class="input-group">
                            <input type="text" class="form-control bibi-form-edit">
                        </div>                                                                                                                               
                    </div>
                    
                    <div class="form__block">
                        <span class="form__caption">Адрес</span>
                        <div class="input-group">
                            <input type="text" class="form-control bibi-form-edit">
                        </div>                                                                                                                               
                    </div>
                    
                    <div class="form__block">
                        <span class="form__caption">
                            <span class="form__caption_tw">Круглосуточно</span>
                            <span class="form__check" id="search_ext__tw-check"></span>
                            <input type="checkbox" class="form__cbx" id="search_ext__tw-cbx" checked="checked">
                        </span>
                    </div>
                    
                    <div class="form__block">
                        <a href="#" title="" class="form__ext-s-btn" id="simple-search-btn">Свернуть</a>
                    </div>
                    
                    <div class="form__block">
                        <button type="button" class="btn bibi-form-btn bibi-form-btn_search">Подобрать</button>
                    </div>
                    
                </form>
            </div>
        </div> <!-- /ext-search -->
        
    </div> <!-- /row -->
</div>

<div class="container-fluid icons">
    <div class="row">
        <div class="container">
            <div class="row">
                <ul class="icons__i-list">
                    <li class="i-list__item"><img src="<?= Url::to('/images/icon-red.png') ?>" alt="">- официальный диллер</li>
                    <li class="i-list__item"><img src="<?= Url::to('/images/icon-cyan.png') ?>" alt="">- универсальный автосервис</li>
                </ul>
            </div> <!-- /row -->
        </div>
    </div> <!-- /row -->
</div>

<div class="container-fluid special-offers-header">
    <div class="row">
        <div class="container">
            <div class="row">
                <span class="special-offers-header__title">Специальные предложения</span>
            </div> <!-- /row -->
        </div>
    </div> <!-- row -->
</div>

<div class="container-fluid special-offers">       
    <div class="row">
            
        <div class="container">
            <div class="row slider-row slider-row_top">
            
                <ul class="slider__viewport">
                    <?php if ($spOffs !== false): ?>
                        <?php foreach ($spOffs as $spOff): ?>
                            <li class="slider__col"><div class="slider__col-header"><?= $spOff->company->name ?></div></li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 3; $i++): ?> 
                            <li class="slider__col"><div class="slider__col-header">Ультра сервис</div></li>
                            <li class="slider__col"><div class="slider__col-header">Сервис-X</div></li>
                            <li class="slider__col"><div class="slider__col-header">Ультра сервис</div></li>
                        <?php endfor ?>
                    <?php endif ?>
                </ul>
            
            </div> <!-- /row -->
        </div>
        
        <div class="container">
            <div class="row slider-row slider-row_middle">
            
                <ul class="slider__viewport" data-current="0">
                    <?php if ($spOffs !== false): ?>
                        <?php foreach ($spOffs as $spOff): ?>
                            <li class="slider__col">
                                <a href="#" title="" class="slider__href" data-cid="<?= $spOff->company_id ?>">
                                    <img src="<?= Url::to($spOff->file->getFileFullName('/images/slide-1.png')) ?>" alt="">
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            
                            <?php for ($j = 1; $j <= 3; $j++): ?>
                                <li class="slider__col">
                                    <a href="#" title="">
                                        <img src="<?= Url::to('/images/slide-' . $j . '.png') ?>" alt="">
                                    </a>
                                </li>
                            <?php endfor ?>
                                
                        <?php endfor ?>
                    <?php endif ?>
                </ul>

                <div class="arrow arrow_left" ></div>
                <div class="arrow arrow_right"></div>
                
            </div> <!-- /row -->
        </div>
                    
        <div class="container">
            <div class="row slider-row slider-row_bottom">
            
                <ul class="slider__viewport">
                    <?php if ($spOffs !== false): ?>
                        <?php foreach ($spOffs as $spOff): ?>
                            <li class="slider__col">
                                <div class="slider__col-footer"><?= $spOff->comment ?></div>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <li class="slider__col">
                                <div class="slider__col-footer">Скидка 20% на замену масла плюс мойка за полцены!<br>С 20 августа по 20 сентября</div>
                            </li>
                            <li class="slider__col">
                                <div class="slider__col-footer">Скидка 20% на замену масла плюс мойка за полцены!<br>С 20 августа по 20 сентября</div>
                            </li>
                            <li class="slider__col">
                                <div class="slider__col-footer">Скидка 20% на замену масла плюс мойка за полцены!<br>С 20 августа по 20 сентября</div>
                            </li>
                        <?php endfor ?>
                    <?php endif ?>
                </ul>
                
            </div> <!-- /row -->                        
        </div>               
                            
    </div> <!-- /row -->
</div>

<div class="container-fluid all-special-offers">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="all-special-offers__btn">
                    <button type="button" class="btn bibi-form-btn bibi-form-btn_sp-off">Смотреть все акции</button>
                </div>
            </div> <!-- /row -->
        </div>       
    </div> <!-- /row -->
</div>
            

