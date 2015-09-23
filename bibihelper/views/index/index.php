<?php

/* @var $this yii\web\View */

use app\assets\IndexAsset;
use yii\helpers\Url;

IndexAsset::register($this);

$this->title = 'BibiHelper';
$this->params["page"] = "index";

?>
<div class="modal fade" id="private-room-entry" tabindex="-1" role="dialog" aria-labelledby="modal-label-pre" aria-hidden="true">
    <div class="modal-dialog modal-dialog_dlg">
    
        <div class="modal-content modal-content_dlg">
        
            <div class="modal-header modal-header_dlg">
                <button type="button" class="close modal-header_close-btn" data-dismiss="modal" aria-hidden="true" id="pre-close">&times;</button>
                <h1 class="modal-title modal-title_dlg">Вход в личный кабинет</h1>
            </div>
            
            <div class="modal-body modal-body_dlg">
                <form>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__caption">Адрес электронной почты:</span>
                        <div class="input-group">
                            <input type="text" class="form-control modal-dialog__edit" id="modal-dialog__edit_email-pre">
                            <span id="modal-dialog__email-ok-pre"></span>
                        </div>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__caption">Пароль:</span>
                        <div class="input-group">
                            <input type="password" class="form-control modal-dialog__edit modal-dialog__edit_psw" id="modal-dialog__edit_psw-pre">
                            <span class="input-group-btn">
                                <button class="btn btn-default pre-btn-psw" type="button" id="modal-dialog__restore-psw" data-dismiss="modal" aria-hidden="true">?</button>
                            </span>
                            <span class="bibi-hint bibi-hint_psw-pre">Забыли пароль?</span>
                        </div>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__check" id="modal-dialog-rmbr__check" data-ch="1"></span>
                        <span class="modal-dialog__caption modal-dialog__caption_rmbr">Запомнить</span>
                    </div>
                    
                    <div class="modal-dialog__block" id="modal-dialog__capcha">
                        <span class="modal-dialog__caption">Введите текст, который видите на картинке:</span>
                        <div class="modal-dialog__capcha">
                            <div class="modal-dialog__capcha-img">
                                <img src="" alt="" id="capcha-img">
                            </div>

                            <div class="input-group">
                                <input type="text" class="form-control modal-dialog__edit modal-dialog_capcha-edit" id="modal-dialog__capcha-edit">
                            </div>
                        </div>

                        <div class="modal-dialog__capcha-refresh">
                            <a href="#" title="" class="modal-dialog__link">Обновить текст</a>
                        </div>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <button type="button" class="btn bibi-form-btn bibi-form-btn-dlg bibi-form-btn-dlg_pre" id="pre-btn">Войти</button>
                    </div>
                    
                    <div class="modal-dialog__block modal-dialog__block_reg">
                        <a href="#" title="" class="modal-dialog__link" id="modal-dialog__link-reg" data-dismiss="modal" aria-hidden="true">Еще не зарегистрировались?</a>
                    </div>
                    
                </form>
            </div> <!-- /modal-body_dlg -->
            
        </div> <!-- /modal-content -->
        
    </div>
</div> <!-- /private-room-entry -->

<div class="modal fade" id="register-company" tabindex="-1" role="dialog" aria-labelledby="modal-label-reg" aria-hidden="true">
    <div class="modal-dialog modal-dialog_dlg">
    
        <div class="modal-content modal-content_dlg">
        
            <div class="modal-header modal-header_dlg">
                <button type="button" class="close modal-header_close-btn" data-dismiss="modal" aria-hidden="true" id="reg-close">&times;</button>
                <h1 class="modal-title modal-title_dlg">Регистрация</h1>
            </div>
            
            <div class="modal-body modal-body_dlg">
                <form>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__caption">Адрес электронной почты:</span>
                        <div class="input-group">
                            <input type="text" class="form-control modal-dialog__edit" id="modal-dialog__edit_email-reg">
                            <span id="modal-dialog__email-ok-reg"></span>
                        </div>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__caption">Пароль:</span>
                        <div class="input-group">
                            <input type="password" class="form-control modal-dialog__edit" id="modal-dialog__edit_psw-reg">
                        </div>
                        <span class="bibi-hint bibi-hint_psw-reg">Минимальная длина пароля - 6 символов</span>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <span class="modal-dialog__caption">Подтвердите пароль:</span>
                        <div class="input-group">
                            <input type="password" class="form-control modal-dialog__edit" id="modal-dialog__edit_psw-confirm-reg">
                        </div>
                        <span class="bibi-hint bibi-hint_psw-confirm-reg">Пароли не совпадают!</span>
                    </div>
                    
                    <div class="modal-dialog__block">
                        <button type="button" class="btn bibi-form-btn bibi-form-btn-dlg bibi-form-btn-dlg_reg" id="reg-btn">Зарегистрироваться</button>
                    </div>
                    
                    <div class="modal-dialog__block modal-dialog__block_reg">
                        <span class="modal-dialog__quest">Уже зарегистрировались?</span>
                        <a href="#" title="" class="modal-dialog__link" id="modal-dialog__link-login" data-dismiss="modal" aria-hidden="true">Войти</a>
                    </div>
                    
                </form>
            </div> <!-- /modal-body_dlg -->
            
        </div> <!-- /modal-content -->
        
    </div>
</div> <!-- /register-company -->

<div class="modal fade" id="restore-psw" tabindex="-3" role="dialog" aria-labelledby="modal-label-restore-psw" aria-hidden="true">
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

<div class="container main">
    <div class="row">
        
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
                                <a href="#" title="">
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
                    <?php if (count($spOffs) > 0): ?>
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
            

