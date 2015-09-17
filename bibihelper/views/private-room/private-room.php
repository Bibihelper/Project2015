<?php

/* @var $this yii\web\View */

use app\assets\PrivateRoomAsset;
use yii\helpers\Url;

PrivateRoomAsset::register($this);

$this->title = 'BibiHelper: ЛК';
$this->params['page'] = 'private-room';
$this->params['company']['user']['email'] = $company->user->email;

?>

<div class="container-fluid pr-room">
    <div class="row">
    
        <div class="container main">
            <div class="row">
                <div class="tabs">
                
                    <ul class="nav nav-tabs nav-tabs_pr">
                        <li class="tab-pr tab-pr_w1 tab-pr_right active"><a href="#profile" data-toggle="tab" class="tab-pr_a">Профиль</a></li>
                        <li class="tab-pr tab-pr_w1"><a href="#options-pr" data-toggle="tab" class="tab-pr_a">Настройки аккаунта</a></li>
                    </ul>
                    
                    <div class="tab-content tab-content_pr">
                        
                        <div id="profile" class="tab-pane fade in active tab-pane_pr">
                            
                            <div class="tab-content__info tab-content__info_h1">
                                <div id="map-pr">
                                    <img src="<?= Url::to('/images/map-pr.png') ?>" title="">
                                </div>
                                <div class="content__info">
                                    <span class="info info__title"><?= $company->name ?></span>
                                    <span class="info info__addr"><?= $company->address->getAddressStr() ?></span>
                                    <?php if ($company->twenty_four_hours): ?>
                                        <span class="info info__shedule">График работы: ежедневно <img src="<?= Url::to('/images/twenty-four-hour.png') ?>" title=""></span>
                                    <?php else: ?>
                                        <span class="info info__shedule">График работы: <?= $shedule ?></span>
                                    <?php endif ?>
                                    <span class="info info__phone"><?= $company->phone ?></span>
                                    <span class="info info__change"><a href="<?= Url::to('/private-room/logout/') ?>" title="">[Изменить]</a></span>
                                    <span class="hidden" id="c-id"><?= $company->id ?></span>
                                </div>
                            </div>
                        
                            <div class="tab-content__info tab-content__info_t">
                                <div class="tabs tabs_t">
                                
                                    <ul class="nav nav-tabs nav-tabs_t">
                                        <li class="tab-pr tab-pr_w2 tab-pr_fs active"><a href="#service" data-toggle="tab" class="tab-pr_a">Оказываемые услуги</a></li>
                                        <li class="tab-pr tab-pr_w2 tab-pr_sd"><a href="#brand" data-toggle="tab" class="tab-pr_a">Марки авто</a></li>
                                        <li class="tab-pr tab-pr_w2 tab-pr_td"><a href="#company-info" data-toggle="tab" class="tab-pr_a">Информация о компании</a></li>
                                        <li class="tab-pr tab-pr_w2 tab-pr_ls"><a href="#sp-off" data-toggle="tab" class="tab-pr_a tab-pr_a-left">Специальное предложение</a></li>
                                    </ul>
                                    
                                    <div class="tab-content">
                                        
                                        <div id="service" class="tab-pane fade in active">

                                            <div class="arrow-ud arrow_up-na"></div>

                                            <ul class="info-s">
                                                
                                                <?php foreach($categories as $ctg): ?>
                                                    <li class="info__item" data-exp="1">
                                                        
                                                        <span class="info__item-label">
                                                            <?= $ctg->name ?>
                                                            <a href="javascript::void(0)" title="" class="arrow-item arrow-item-left" data-exp="0">
                                                                <img src="<?= Url::to('/images/arrow-item-right.png') ?>" alt="">
                                                            </a>
                                                        </span>
                                                        
                                                        <ul class="item-menu item-menu_m">
                                                            <?php if (count($ctg->service) != 0): ?>
                                                                <li class="item-menu__i item-menu__i_first">
                                                                    <span class="item-menu__i-label">Выбрать все</span>
                                                                    <?php if (count($company->getService()->filterByCategory($ctg->id)->all()) == count($ctg->service)): ?>
                                                                        <div class="info__chbx">
                                                                            <span class="info__cbx info__cbx_active" data-ch="1"></span>  
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="info__chbx">
                                                                            <span class="info__cbx" data-ch="0"></span>  
                                                                        </div>
                                                                    <?php endif ?>
                                                                </li>
                                                                <?php foreach($ctg->service as $srv): ?>
                                                                    <li class="item-menu__i">
                                                                        <span class="item-menu__i-label"><?= $srv->name ?></span>
                                                                        <?php if (count($company->getService()->filterByCategory($ctg->id)->filterByService($srv->id)->all()) == 0): ?>
                                                                            <div class="info__chbx">
                                                                                <span class="info__cbx" data-ch="0"></span>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="info__chbx">
                                                                                <span class="info__cbx info__cbx_active" data-ch="1"></span>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </li>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </ul>
                                                        
                                                    </li>
                                                <?php endforeach ?>
                                                    
                                            </ul>
                                            
                                            <div class="arrow-ud arrow_down-a"></div>
                                            
                                        </div>
                                        
                                        <div id="brand" class="tab-pane fade">

                                            <div class="arrow-ud arrow_up-na"></div>

                                            <ul class="info-s">
                                                <!--
                                                <li class="info__item">
                                                    <span class="info__item-label">Все</span>
                                                    <span class="info__chbx info__chbx_all">
                                                        <div class="info__cbx" data-ch="0"></div>
                                                    </span>
                                                </li>
                                                -->
                                                
                                                <?php foreach($countries as $cntr): ?>
                                                    <li class="info__item" data-exp="1">
                                                        
                                                        <span class="info__item-label">
                                                            <?= $cntr->country ?>
                                                            <a href="javascript::void(0)" title="" class="arrow-item arrow-item-left" data-exp="0">
                                                                <img src="<?= Url::to('/images/arrow-item-right.png') ?>" alt="">
                                                            </a>
                                                        </span>
                                                        
                                                        <ul class="item-menu item-menu_m">
                                                            <?php if (count($cntr->brand) != 0): ?>
                                                                <li class="item-menu__i item-menu__i_first">
                                                                    <span class="item-menu__i-label">Выбрать все</span>
                                                                    <?php if (count($company->getBrand()->filterByCountry($cntr->country)->all()) == count($cntr->brand)): ?>
                                                                        <div class="info__chbx">
                                                                            <span class="info__cbx info__cbx_active" data-ch="1"></span>  
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="info__chbx">
                                                                            <span class="info__cbx" data-ch="0"></span>  
                                                                        </div>
                                                                    <?php endif ?>
                                                                </li>
                                                                <?php foreach($cntr->brand as $brand): ?>
                                                                    <li class="item-menu__i">
                                                                        <span class="item-menu__i-label"><?= $brand->name ?></span>
                                                                        <?php if (count($company->getBrand()->filterByCountry($cntr->country)->filterByBrand($brand->id)->all()) == 0): ?>
                                                                            <div class="info__chbx">
                                                                                <span class="info__cbx" data-ch="0"></span>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="info__chbx">
                                                                                <span class="info__cbx info__cbx_active" data-ch="1"></span>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </li>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </ul>
                                                        
                                                    </li>
                                                <?php endforeach ?>
                                                    
                                            </ul>
                                            
                                            <div class="arrow-ud arrow_down-a"></div>
                                            
                                        </div>
                                        <div id="company-info" class="tab-pane fade">

                                            <div class="info-c">
                                                <textarea class="info-c__text"><?= $company->comment ?></textarea>
                                            </div>

                                            <div class="info-c__btn">
                                                <button type="button" class="btn bibi-form-btn info-c__btn_save">Сохранить</button>
                                            </div>
                    
                                        </div>
                                        <div id="sp-off" class="tab-pane fade">

                                            <div class="s-off">
                                                
                                                <div class="s-off-ctrls">
                                                    <form>
                                                    
                                                        <div class="c-block">
                                                            <span class="c-caption">Выберете картинку для акции.</span>
                                                            <button type="button" class="btn s-off-btn" id="s-browse">Обзор</button><input type="text" class="form-control c-edit s-off-edit_m" placeholder="Фото.jpg" id="s-filename">
                                                            <button type="button" class="btn s-off-btn s-off-btn_m disabled" id="s-load-image">Загрузить</button>
                                                            <input type="file" id="s-br" name="sBr" accept="image/jpeg, image/png, image/gif">
                                                        </div>
                                                        
                                                        <div class="c-block">
                                                            <span class="c-caption">Период действия предложения:</span>
                                                            
                                                            <span class="c-caption s-off-caption_b">с</span>
                                                            <input type="text" id="datepicker1">
                                                            <span class="c-arrow c-arrow_expand c-arrow_1" id="c-arrow-1"></span>
                                                            
                                                            <span class="c-caption s-off-caption_e">по</span>
                                                            <input type="text" id="datepicker2">
                                                            <span class="c-arrow c-arrow_expand c-arrow_2" id="c-arrow-2"></span>
                                                        </div>
                                                        
                                                        <div class="c-block">
                                                            <span class="c-caption">Описание предложения (макс. 50 символов):</span>
                                                            <input type="text" class="form-control c-edit s-off-edit_m2" id="s-descr-edit" maxlength="50" value="">
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                                
                                                <div class="s-off-preview">
                                                
                                                    <div class="preview-block">
                                                        <span class="prtxt prtxt_caption">Предпоказ акции:</span>
                                                        <span class="prtxt prtxt_title"><?= $company->name ?></span>
                                                        <div class="primg">
                                                            <img src="<?= Url::to('/images/s-img.png') ?>" alt="" id="s-image">
                                                        </div>
                                                        <span class="prtxt prtxt_text" id="s-descr"></span>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="info-c__btn">
                                                <button type="button" class="btn bibi-form-btn info-c__btn_save disabled" id="s-publish" data-btn-type="1">Опубликовать</button>
                                            </div>
                    
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> <!-- /tab-content__info -->
                        
                        </div>
                        
                        <div id="options-pr" class="tab-pane fade">

                            <div class="opt">

                                <span class="opt-title">Личные настройки аккаунта</span>
                                
                                <form>
                                    <div class="c-block c-block_m">
                                        <span class="c-caption">Сменить пароль:</span>
                                        <input type="password" class="form-control c-edit c-edit_m" placeholder="Старый пароль" id="psw-old">
                                        <input type="password" class="form-control c-edit c-edit_m" placeholder="Новый пароль" id="psw-new">
                                        <input type="password" class="form-control c-edit c-edit_m" placeholder="Подтверждение" id="psw-confirm">
                                        <div class="info-c__btn info-c__btn_m">
                                            <button type="button" class="btn bibi-form-btn info-c__btn_save" id="save-psw">Сохранить</button>
                                        </div>
                                    </div>
                                    <div class="c-block c-block_m2">
                                        <span class="c-caption">Сменить e-mail:</span>
                                        <input type="email" class="form-control c-edit c-edit_m" id="new-email" value="<?= $company->user->email ?>">
                                        <div class="info-c__btn info-c__btn_m">
                                            <button type="button" class="btn bibi-form-btn info-c__btn_save" id="save-email">Сохранить</button>
                                        </div>
                                    </div>
                                    <div class="c-block">
                                        <span class="c-caption c-caption_m">Настройки уведомлений:</span>
                                        <span class="c-cbx" data-ch="0" id="send-site-news"></span>
                                        <span class="c-caption c-caption_m">Новости сайта</span>
                                    </div>
                                </form>

                            </div>

                        </div>
                        
                    </div> <!-- /tab-content -->
                    
                </div> <!-- /tabs -->
            </div> <!-- /row -->
        </div>

    </div> <!-- /row -->
</div>

