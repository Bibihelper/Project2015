<?php

/* @var $this yii\web\View */

use app\assets\PrivateRoomAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

PrivateRoomAsset::register($this);

$this->title = 'BibiHelper: ЛК';
$this->params['page'] = 'private-room';
$this->params['user']['email'] = $company->user->email;

?>

<div class="container-fluid pr-room">
    <div class="row">
        <div class="container main">
            <div class="row">
                <div class="tabs">
                    <ul class="nav nav-tabs nav-tabs-pr">
                        <li class="tab-pr tab-pr-w1 tab-pr-right active"><a href="#profile" data-toggle="tab" class="tab-pr-a">Профиль</a></li>
                        <li class="tab-pr tab-pr-w1"><a href="#user-options" data-toggle="tab" class="tab-pr-a">Настройки аккаунта</a></li>
                    </ul>
                    
                    <div class="tab-content tab-content-pr">
                        <div id="profile" class="tab-pane fade in active tab-pane-pr">
                            <div class="tab-content-info tab-content-info-h1">
                                <div id="private-room-map-id"></div>
                                
                                <div class="content-info">
                                    <span class="info info-title"><?= $company->name ?></span>
                                    <span class="info info-addr"><?= $company->address->getAddressStr() ?></span>
                                    <?php if ($company->twenty_four_hours): ?>
                                        <span class="info info-shedule">График работы: ежедневно <img src="<?= Url::to('/images/twenty-four-hour.png') ?>" title=""></span>
                                    <?php else: ?>
                                        <span class="info info-shedule">График работы:</span>
                                        <div class="info info-shedule info-shedule-m"><?= $shedule ?></div>
                                    <?php endif ?>
                                    <span class="info info-phone"><?= $company->phone ?></span>
                                    <span class="info info-change"><a href="#" title="" id="opt-ch">[Изменить]</a></span>
                                    <span class="info info-change"><a href="<?= Url::to('/user/logout/') ?>" title="">[Выйти]</a></span>
                                    <span class="hidden" id="cid"><?= $company->id ?></span>
                                </div>
                            </div>
                        
                            <div class="tab-content-info tab-content-info-t">
                                <div class="tabs tabs-t">
                                
                                    <ul class="nav nav-tabs nav-tabs-t">
                                        <li class="tab-pr tab-pr-w2 tab-pr_fs active"><a href="#service" data-toggle="tab" class="tab-pr-a">Оказываемые услуги</a></li>
                                        <li class="tab-pr tab-pr-w2 tab-pr_sd"><a href="#brand" data-toggle="tab" class="tab-pr-a">Марки авто</a></li>
                                        <li class="tab-pr tab-pr-w2 tab-pr_td"><a href="#company-info" data-toggle="tab" class="tab-pr-a">Информация о компании</a></li>
                                        <li class="tab-pr tab-pr-w2 tab-pr_ls"><a href="#sp-off" data-toggle="tab" class="tab-pr-a tab-pr-a-left">Специальное предложение</a></li>
                                    </ul>
                                    
                                    <div class="tab-content">
                                        
                                        <div id="service" class="tab-pane fade in active">
                                            <div class="arrow-ud arrow_up-na"></div>

                                            <ul class="info-s">
                                                <?php foreach($categories as $ctg): ?>
                                                    <li class="info-item" data-exp="1">
                                                        
                                                        <span class="info-item-label">
                                                            <span class="info-item-label-text"><?= $ctg->name ?></span>
                                                            <a href="javascript::void(0)" title="" class="arrow-item arrow-item-left info-item-label-arrow" data-exp="0">
                                                                <img src="<?= Url::to('/images/arrow-item-right.png') ?>" alt="">
                                                            </a>
                                                        </span>
                                                        
                                                        <ul class="item-menu item-menu-m">
                                                            <?php if (count($ctg->service) != 0): ?>
                                                            
                                                                <li class="item-menu-i item-menu-ifirst">
                                                                    <span class="item-menu-ilabel">Выбрать все</span>
                                                                    
                                                                    <?php if (count($company->getService()->filterByCategory($ctg->id)->all()) == count($ctg->service)): ?>
                                                                        <div class="info-chbx">
                                                                            <span class="info-cbx info-cbx-active" data-ch="1" data-type="select-all"></span>  
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="info-chbx">
                                                                            <span class="info-cbx" data-ch="0" data-type="sellect-all"></span>  
                                                                        </div>
                                                                    <?php endif ?>
                                                                </li>
                                                                
                                                                <?php foreach($ctg->service as $srv): ?>
                                                                    <li class="item-menu-i">
                                                                        <span class="item-menu-ilabel"><?= $srv->name ?></span>
                                                                        
                                                                        <?php if (count($company->getService()->filterByCategory($ctg->id)->filterByService($srv->id)->all()) == 0): ?>
                                                                            <div class="info-chbx">
                                                                                <span class="info-cbx" data-ch="0" data-cid="<?= $company->id ?>" data-sid="<?= $srv->id ?>" data-type="service"></span>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="info-chbx">
                                                                                <span class="info-cbx info-cbx-active" data-ch="1" data-cid="<?= $company->id ?>" data-sid="<?= $srv->id ?>" data-type="service"></span>
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
                                                <?php foreach($countries as $cntr): ?>
                                                    <li class="info-item" data-exp="1">
                                                        
                                                        <span class="info-item-label">
                                                            <span class="info-item-label-text"><?= $cntr->country ?></span>
                                                            <a href="javascript::void(0)" title="" class="arrow-item arrow-item-left info-item-label-arrow" data-exp="0">
                                                                <img src="<?= Url::to('/images/arrow-item-right.png') ?>" alt="">
                                                            </a>
                                                        </span>
                                                        
                                                        <ul class="item-menu item-menu-m">
                                                            <?php if (count($cntr->brand) != 0): ?>
                                                            
                                                                <li class="item-menu-i item-menu-ifirst">
                                                                    <span class="item-menu-ilabel">Выбрать все</span>
                                                                    <?php if (count($company->getBrand()->filterByCountry($cntr->country)->all()) == count($cntr->brand)): ?>
                                                                        <div class="info-chbx">
                                                                            <span class="info-cbx info-cbx-active" data-ch="1" data-type="sellect-all"></span>  
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="info-chbx">
                                                                            <span class="info-cbx" data-ch="0" data-type="sellect-all"></span>  
                                                                        </div>
                                                                    <?php endif ?>
                                                                </li>
                                                                
                                                                <?php foreach($cntr->brand as $brand): ?>
                                                                    <li class="item-menu-i">
                                                                        <span class="item-menu-ilabel"><?= $brand->name ?></span>
                                                                        <?php if (count($company->getBrand()->filterByCountry($cntr->country)->filterByBrand($brand->id)->all()) == 0): ?>
                                                                            <div class="info-chbx">
                                                                                <span class="info-cbx" data-ch="0"  data-cid="<?= $company->id ?>" data-sid="<?= $brand->id ?>" data-type="brand"></span>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="info-chbx">
                                                                                <span class="info-cbx info-cbx-active" data-ch="1" data-cid="<?= $company->id ?>" data-sid="<?= $brand->id ?>" data-type="brand"></span>
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
                                            <div class="ci-block">
                                                <?php $form = ActiveForm::begin(['id' => 'company-info-form']); ?>
                                                    <?= $form->field($cInfFrm, 'info', [
                                                            'options' => ['class' => 'form-group'],
                                                            'template' => "{input}\n",
                                                        ])->textarea([
                                                            'class' => 'f-textarea', 'id' => 'ci-info'
                                                        ])->label(false)
                                                    ?>
                                                    <?= $form->field($cInfFrm, 'id')->hiddenInput()->label(false) ?>
                                                    <div class="form-group c-tar">
                                                        <?= Html::button('Сохранить', ['class' => 'f-button f-submit', 'id' => 'ci-submit', 'disabled' => 'disabled']) ?>
                                                    </div>
                                                <?php ActiveForm::end(); ?>
                                            </div>
                                        </div>
                                        
                                        <div id="sp-off" class="tab-pane fade" data-cid="<?= $company->id ?>" data-soid="<?= $company->specialOffer->id ?>">
                                            <div class="s-off">
                                                
                                                <div class="s-off-ctrls" style="<?= $company->hasOffer() ? "display: none;" : "display: block;" ?>">
                                                    <div class="c-block">
                                                        <span class="c-caption">Выберете картинку для акции.</span>
                                                        <button type="button" class="btn s-off-btn" id="s-browse">Обзор</button><input type="text" class="form-control c-edit s-off-edit_m" placeholder="Фото.jpg" id="s-filename">
                                                        <button type="button" class="btn s-off-btn s-off-btn_m disabled" id="s-load-image">Загрузить</button>
                                                        <input type="file" id="s-br" name="sBr" accept="image/jpeg, image/png, image/gif">
                                                    </div>

                                                    <div class="c-block">
                                                        <span class="c-caption">Период действия предложения:</span>

                                                        <span class="c-caption c-caption-m">с</span>
                                                        <input type="text" id="datepicker1">
                                                        <span class="c-arrow c-arrow_expand c-arrow_1" id="c-arrow-1"></span>

                                                        <span class="c-caption c-caption-m">по</span>
                                                        <input type="text" id="datepicker2">
                                                        <span class="c-arrow c-arrow_expand c-arrow_2" id="c-arrow-2"></span>
                                                    </div>

                                                    <div class="c-block">
                                                        <span class="c-caption">Описание предложения (макс. 50 символов):</span>
                                                        <input type="text" class="form-control c-edit s-off-edit_m2" id="s-descr-edit" maxlength="50" value="<?= $company->specialOffer->comment ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="s-off-preview" style="<?= $company->hasOffer() ? "float: none;" : "float: right;" ?>">
                                                    <div class="preview-block">
                                                        <span class="prtxt prtxt_caption">Предпоказ акции:</span>
                                                        <span class="prtxt prtxt_title"><?= $company->name ?></span>
                                                        <div class="primg">
                                                            <img src="<?= Url::to($company->specialOffer->file->getFileFullName()) ?>" alt="" id="s-image">
                                                        </div>
                                                        <span class="prtxt prtxt_text" id="s-descr"><?= $company->specialOffer->comment ?></span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="button-block">
                                                <?php if ($company->hasOffer()): ?>
                                                    <button type="button" class="f-button f-submit" id="s-publish" data-btn-type="2">Удалить предложение</button>
                                                <?php else: ?>
                                                    <button type="button" class="f-button f-submit disabled" id="s-publish" data-btn-type="1">Опубликовать</button>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                 
                            <div class="tab-content-info" style="display: none;">
                                <div class="opt-frm">
                                    <form method="post" action="<?= Url::to("/private-room/options-save") ?>">
                                        <div class="frm-hint" id="frm-hint-1">
                                            <span class="hint-text">Допустим ввод символов руссокго и латинского алфавитов и знака - </span>
                                        </div>
                                        <div class="frm-block frm-block_ta">
                                            <span class="frm-header">Данные автосервиса</span>
                                        </div>
                                        <div class="frm-block">
                                            <span class="ctrl-title">Название автосервиса:</span>
                                            <input type="text" class="text-edit" value="<?= $company->name ?>" id="company_name" name="company_name_2">
                                        </div>
                                        <div class="frm-block">
                                            <span class="ctrl-title not-req-t">Регион:</span>
                                            <input type="text" class="text-edit not-req" value="<?= $company->address->region ?>" id="address_reginon" name="address_reginon_2">
                                        </div>
                                        <div class="frm-block">
                                            <span class="ctrl-title">Город:</span>
                                            <input type="text" class="text-edit" value="<?= $company->address->city ?>" id="address_city" name="address_city_2">
                                        </div>
                                        <div class="frm-block">
                                            <span class="ctrl-title">Район:</span>
                                            <input type="text" class="text-edit" value="<?= $company->address->district ?>" id="address_district" name="address_district_2">
                                        </div>
                                        <div class="frm-block">
                                            <span class="ctrl-title">Улица:</span>
                                            <input type="text" class="text-edit" maxlength="256" placeholder="не более 256 символов" value="<?= $company->address->street ?>" id="address_street" name="address_street_2">
                                        </div>
                                        <div class="frm-block">
                                            <div class="frm-block frm-block_inline frm-block_nm">
                                                <span class="ctrl-title">Дом:</span>
                                                <input type="text" class="text-edit" maxlength="10" placeholder="не более 10 с." value="<?= $company->address->home ?>" id="address_home" name="address_home_2">
                                            </div>

                                            <div class="frm-block frm-block_inline frm-block_nm">
                                                <span class="ctrl-title">Корпус:</span>
                                                <input type="text" class="text-edit" maxlength="10" placeholder="не более 10 с." value="<?= $company->address->housing ?>" id="address_housing" name="address_housing_2">
                                            </div>

                                            <div class="frm-block frm-block_inline frm-block_nm">
                                                <span class="ctrl-title">Строение:</span>
                                                <input type="text" class="text-edit" maxlength="10" placeholder="не более 10 с." value="<?= $company->address->building ?>" id="address_building" name="address_building_2">
                                            </div>
                                        </div>
                                        <div class="frm-block">
                                            <span class="ctrl-title not-req-t">Станция метро:</span>
                                            <input type="text" class="text-edit not-req" value="<?= $company->address->metro ?>" id="address_metro" name="address_metro_2">
                                        </div>
                                        <div class="frm-block">
                                            <span class="ctrl-title ctrl-title_mb">График работы:</span>
                                            <div class="frm-block" id="shedule_twenty_four_hours">
                                                <span class="info-cbx-inline <?= $company->twenty_four_hours ? "info-cbx-active" : "" ?>" id="shedule_twfh"
                                                      data-ch="<?= $company->twenty_four_hours ?>"></span><span class="info-cbx-caption">круглосуточно</span>
                                            </div>
                                            <div class="frm-block">
                                                <div class="frm-block frm-block_inline frm-block_top frm-block_nm">
                                                    <span class="info-cbx-inline <?= $company->getShedule()->isEveryDay() == 1 ? "info-cbx-active" : "" ?>"
                                                          data-ch="<?= $company->getShedule()->isEveryDay() ?>" id="shedule_every_day"></span><span class="info-cbx-caption">ежедневно</span>
                                                </div>
                                                <div class="frm-block frm-block_inline frm-block_nm" id="shedule_days" <?= $company->getShedule()->isEveryDay() == 1 ? 'style="display: none;"' : '' ?>>
                                                    <ul class="week">
                                                        <li><span class="info-cbx-inline <?= $company->getShedule()->hasDay(1) == 1 ? "info-cbx-active" : "" ?>" data-ch="<?= $company->getShedule()->hasDay(1) ?>" id="shedule_mon"></span><span class="info-cbx-caption">понедельник</span></li>
                                                        <li><span class="info-cbx-inline <?= $company->getShedule()->hasDay(2) == 1 ? "info-cbx-active" : "" ?>" data-ch="<?= $company->getShedule()->hasDay(2) ?>" id="shedule_tue"></span><span class="info-cbx-caption">вторник</span></li>
                                                        <li><span class="info-cbx-inline <?= $company->getShedule()->hasDay(3) == 1 ? "info-cbx-active" : "" ?>" data-ch="<?= $company->getShedule()->hasDay(3) ?>" id="shedule_wed"></span><span class="info-cbx-caption">среда</span></li>
                                                        <li><span class="info-cbx-inline <?= $company->getShedule()->hasDay(4) == 1 ? "info-cbx-active" : "" ?>" data-ch="<?= $company->getShedule()->hasDay(4) ?>" id="shedule_thu"></span><span class="info-cbx-caption">четверг</span></li>
                                                        <li><span class="info-cbx-inline <?= $company->getShedule()->hasDay(5) == 1 ? "info-cbx-active" : "" ?>" data-ch="<?= $company->getShedule()->hasDay(5) ?>" id="shedule_fri"></span><span class="info-cbx-caption">пятница</span></li>
                                                        <li><span class="info-cbx-inline <?= $company->getShedule()->hasDay(6) == 1 ? "info-cbx-active" : "" ?>" data-ch="<?= $company->getShedule()->hasDay(6) ?>" id="shedule_sat"></span><span class="info-cbx-caption">суббота</span></li>
                                                        <li><span class="info-cbx-inline <?= $company->getShedule()->hasDay(7) == 1 ? "info-cbx-active" : "" ?>" data-ch="<?= $company->getShedule()->hasDay(7) ?>" id="shedule_sun"></span><span class="info-cbx-caption">воскресенье</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="frm-block" id="shedule_clock" <?= $company->twenty_four_hours ? 'style="display: none"' : '' ?>>
                                                <div class="frm-block frm-block_inline frm-block_nm frm-block_w">
                                                    <span class="period-caption">с</span>
                                                    <div class="counter">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-hours" id="b_hour" data-time="<?= $company->getShedule()->getHour() ?>">
                                                            <img src="<?= Url::to("/images/dial-hours.png") ?>" alt="" style="top: <?= -25 * $company->getShedule()->getHour() ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                    </div>
                                                    <div class="counter counter_m">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-minutes" id="b_minute" data-time="<?= $company->getShedule()->getMinute() ?>">
                                                            <img src="<?= Url::to("/images/dial-minutes.png") ?>" alt="" style="top: <?= -25 * (int) floor($company->getShedule()->getMinute() /15) ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                    </div>
                                                </div>
                                                <div class="frm-block frm-block_inline frm-block_nm frm-block_w">
                                                    <span class="period-caption">до</span>
                                                    <div class="counter">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-hours" id="e_hour" data-time="<?= $company->getShedule()->getHour('end') ?>">
                                                            <img src="<?= Url::to("/images/dial-hours.png") ?>" alt="" style="top: <?= -25 * $company->getShedule()->getHour('end') ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                    </div>
                                                    <div class="counter counter_m">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-minutes" id="e_minute" data-time="<?= $company->getShedule()->getMinute('end') ?>">
                                                            <img src="<?= Url::to("/images/dial-minutes.png") ?>" alt="" style="top: <?= -25 * (int) floor($company->getShedule()->getMinute('end') / 15) ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="frm-block frm-block_mb">
                                            <span class="ctrl-title">Телефон:</span>
                                            <input type="text" class="text-edit" placeholder="+7 (_ _ _) _ _ _-_ _-_ _" value="<?= $company->phone ?>" id="company_phone" name="company_phone_2">
                                        </div>
                                        <div class="frm-block">
                                            <div class="button-block-2">
                                                <button type="submit" class="f-button f-submit" id="save-opt">Сохранить</button>
                                            </div>
                                        </div>
                                        <div class="frm-data">
                                            <input type="hidden" value="<?= $company->twenty_four_hours ?>" id="shedule_twfh_2" name="shedule_twfh_2">
                                            <input type="hidden" value="<?= $company->getShedule()->hasDay(1) ?>" id="shedule_mon_2" name="shedule_mon_2">
                                            <input type="hidden" value="<?= $company->getShedule()->hasDay(2) ?>" id="shedule_tue_2" name="shedule_tue_2">
                                            <input type="hidden" value="<?= $company->getShedule()->hasDay(3) ?>" id="shedule_wed_2" name="shedule_wed_2">
                                            <input type="hidden" value="<?= $company->getShedule()->hasDay(4) ?>" id="shedule_thu_2" name="shedule_thu_2">
                                            <input type="hidden" value="<?= $company->getShedule()->hasDay(5) ?>" id="shedule_fri_2" name="shedule_fri_2">
                                            <input type="hidden" value="<?= $company->getShedule()->hasDay(6) ?>" id="shedule_sat_2" name="shedule_sat_2">
                                            <input type="hidden" value="<?= $company->getShedule()->hasDay(7) ?>" id="shedule_sun_2" name="shedule_sun_2">
                                            <input type="hidden" value="<?= $company->getShedule()->getHour() ?>" id="b_hour_2" name="b_hour_2">
                                            <input type="hidden" value="<?= $company->getShedule()->getMinute() ?>" id="b_minute_2" name="b_minute_2">
                                            <input type="hidden" value="<?= $company->getShedule()->getHour('end') ?>" id="e_hour_2" name="e_hour_2">
                                            <input type="hidden" value="<?= $company->getShedule()->getMinute('end') ?>" id="e_minute_2" name="e_minute_2">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div id="user-options" class="tab-pane fade">
                            <div class="options">
                                <span class="options-title">Личные настройки аккаунта</span>
                                
                                <?php $form = ActiveForm::begin([
                                    'id' => 'change-password-form',
                                    'enableAjaxValidation' => true,
                                    'action' => Url::to('/user/change-password/'),
                                    'validationUrl' => Url::to('/private-room/validate-change-password-form/'),
                                    'successCssClass' => '',
                                ]); ?>
                                    <div class="c-block">
                                        <span class="c-caption">Сменить пароль:</span>

                                        <?= $form->field($cPasFrm, 'old_password', [
                                                'options' => ['class' => 'form-group f-group']
                                            ])->passwordInput([
                                                'class' => 'form-control f-control', 'placeholder' => 'Старый пароль'
                                            ])->label(false) 
                                        ?>

                                        <?= $form->field($cPasFrm, 'new_password', [
                                                'options' => ['class' => 'form-group f-group']
                                            ])->passwordInput([
                                                'class' => 'form-control f-control', 'placeholder' => 'Новый пароль'
                                            ])->label(false) 
                                        ?>

                                        <?= $form->field($cPasFrm, 'ok_password', [
                                                'options' => ['class' => 'form-group f-group']
                                            ])->passwordInput([
                                                'class' => 'form-control f-control', 'placeholder' => 'Подтверждение'
                                            ])->label(false) 
                                        ?>

                                        <div class="form-group f-group c-tar">
                                            <?= Html::submitButton('Сохранить', ['class' => 'f-button f-submit', 'id' => 'cpf-submit']) ?>
                                        </div>
                                    </div>
                                <?php ActiveForm::end(); ?>

                                <?php $form = ActiveForm::begin([
                                    'id' => 'change-email-form',
                                    'enableAjaxValidation' => true,
                                    'action' => Url::to('/user/change-email/'),
                                    'validationUrl' => Url::to('/private-room/validate-change-email-form/'),
                                    'successCssClass' => '',
                                ]); ?>
                                    <div class="c-block">
                                        <span class="c-caption">Сменить e-mail:</span>

                                        <?= $form->field($cEmailFrm, 'email', [
                                                'options' => ['class' => 'form-group f-group']
                                            ])->textInput([
                                                'class' => 'form-control f-control'
                                            ])->label(false) 
                                        ?>

                                        <div class="form-group f-group c-tar">
                                            <?= Html::submitButton('Сохранить', ['class' => 'f-button f-submit', 'id' => 'cef-submit']) ?>
                                        </div>
                                    </div>
                                <?php ActiveForm::end(); ?>

                                <div class="c-block">
                                    <span class="c-caption c-caption-m">Настройки уведомлений:</span>
                                    <input type="checkbox" class="f-checkbox" id="site-news">
                                    <label for="site-news" class="f-label">Новости сайта</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

