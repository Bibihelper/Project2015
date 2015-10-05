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
                                                        <button type="button" class="btn s-off-btn s-off-btn_m" id="s-load-image" disabled>Загрузить</button>
                                                        <input type="file" id="s-br" name="sBr" accept="image/jpeg, image/png, image/gif">
                                                    </div>

                                                    <div class="c-block">
                                                        <span class="c-caption">Период действия предложения:</span>
                                                        
                                                        <div class="s-off-active-from">
                                                            <span class="c-caption c-caption-m">с</span>
                                                            <div class="dtpckr">
                                                                <input type="text" id="datepicker1">
                                                                <span class="c-arrow c-arrow_expand c-arrow_1" id="c-arrow-1"></span>
                                                            </div>
                                                        </div>

                                                        <div class="s-off-active-from">
                                                            <span class="c-caption c-caption-m">по</span>
                                                            <div class="dtpckr">
                                                                <input type="text" id="datepicker2">
                                                                <span class="c-arrow c-arrow_expand c-arrow_2" id="c-arrow-2"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="c-block">
                                                        <span class="c-caption">Описание предложения (макс. 50 символов):</span>
                                                        <input type="text" class="form-control c-edit s-off-edit_m2" id="s-descr-edit" maxlength="50" value="<?= $company->specialOffer->comment ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="s-off-preview" style="<?= $company->hasOffer() ? "float: none;" : "float: right;" ?>">
                                                    <div class="preview-block">
                                                        <span class="prtxt prtxt-caption">Предпоказ акции:</span>
                                                        <span class="prtxt prtxt-title"><?= $company->name ?></span>
                                                        <div class="primg">
                                                            <img src="<?= Url::to($company->specialOffer->file->getFileFullName()) ?>" alt="" id="s-image">
                                                        </div>
                                                        <span class="prtxt prtxt-text" id="s-descr"><?= $company->specialOffer->comment ?></span>
                                                        <span class="prtxt prtxt-text" id="s-period"><?= $company->specialOffer->getPeriod() ?></span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="button-block">
                                                <?php if ($company->hasOffer()): ?>
                                                    <button type="button" class="f-button f-submit" id="s-publish" data-btn-type="2">Удалить предложение</button>
                                                <?php else: ?>
                                                    <button type="button" class="f-button f-submit" id="s-publish" data-btn-type="1" disabled>Опубликовать</button>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                 
                            <div class="tab-content-info" style="display: none;">
                                <div class="opt-frm">
                                    <div class="f-block f-block-ta">
                                        <span class="opt-frm-header">Данные автосервиса</span>
                                    </div>
                                    
                                    <?php $form = ActiveForm::begin([
                                        'id' => 'options-form',
                                        'enableAjaxValidation' => true,
                                        'action' => Url::to('/private-room/save-options'),
                                        'validationUrl' => Url::to('/private-room/validate-options-form/'),
                                        'successCssClass' => '',
                                    ]); ?>
                                    
                                        <?= $form->field($cOptFrm, 'id', ['options' => ['class' => 'f-block'], 'template' => "{input}\n"])->hiddenInput()->label(false) ?>

                                        <?= $form->field($cOptFrm, 'company_name', [
                                                'options' => ['class' => 'f-block']
                                            ])->textInput([
                                                'class' => 'form-control f-control'
                                            ])->label($cOptFrm->getAttributeLabel('company_name'), [
                                                'class' => 'f-label'
                                            ])
                                        ?>
                    
                                        <?= $form->field($cOptFrm, 'address_region', [
                                                'options' => ['class' => 'f-block']
                                            ])->textInput([
                                                'class' => 'form-control f-control not-req'
                                            ])->label($cOptFrm->getAttributeLabel('address_region'), [
                                                'class' => 'f-label not-req-t'
                                            ])
                                        ?>
                    
                                        <?= $form->field($cOptFrm, 'address_city', [
                                                'options' => ['class' => 'f-block']
                                            ])->textInput([
                                                'class' => 'form-control f-control'
                                            ])->label($cOptFrm->getAttributeLabel('address_city'), [
                                                'class' => 'f-label'
                                            ])
                                        ?>
                    
                                        <?= $form->field($cOptFrm, 'address_district', [
                                                'options' => ['class' => 'f-block']
                                            ])->textInput([
                                                'class' => 'form-control f-control'
                                            ])->label($cOptFrm->getAttributeLabel('address_district'), [
                                                'class' => 'f-label'
                                            ])
                                        ?>
                    
                                        <?= $form->field($cOptFrm, 'address_street', [
                                                'options' => ['class' => 'f-block']
                                            ])->textInput([
                                                'class' => 'form-control f-control', 'maxlength' => 255, 'placeholder' => 'не более 255 символов'
                                            ])->label($cOptFrm->getAttributeLabel('address_street'), [
                                                'class' => 'f-label'
                                            ])
                                        ?>
                                    
                                        <div class="f-block">
                                            <?= $form->field($cOptFrm, 'address_home', [
                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm']
                                                ])->textInput([
                                                    'class' => 'form-control f-control', 'maxlength' => 10, 'placeholder' => 'не более 10 с.'
                                                ])->label($cOptFrm->getAttributeLabel('address_home'), [
                                                    'class' => 'f-label'
                                                ])
                                            ?>

                                            <?= $form->field($cOptFrm, 'address_housing', [
                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm']
                                                ])->textInput([
                                                    'class' => 'form-control f-control', 'maxlength' => 10, 'placeholder' => 'не более 10 с.'
                                                ])->label($cOptFrm->getAttributeLabel('address_housing'), [
                                                    'class' => 'f-label'
                                                ])
                                            ?>

                                            <?= $form->field($cOptFrm, 'address_building', [
                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm']
                                                ])->textInput([
                                                    'class' => 'form-control f-control', 'maxlength' => 10, 'placeholder' => 'не более 10 с.'
                                                ])->label($cOptFrm->getAttributeLabel('address_building'), [
                                                    'class' => 'f-label'
                                                ])
                                            ?>
                                        </div>
                    
                                        <?= $form->field($cOptFrm, 'address_metro', [
                                                'options' => ['class' => 'f-block']
                                            ])->textInput([
                                                'class' => 'form-control f-control not-req'
                                            ])->label($cOptFrm->getAttributeLabel('address_metro'), [
                                                'class' => 'f-label not-req-t'
                                            ])
                                        ?>
                    
                                        <div class="f-block">
                                            <span class="ctrl-title ctrl-title-mb">График работы:</span>
                                            
                                            <?= $form->field($cOptFrm, 'shedule_twfhr', [
                                                    'options' => ['class' => 'f-block'],
                                                    'checkboxTemplate' => "{input}\n{label}"
                                                ])->checkbox([
                                                    'class' => 'f-checkbox'
                                                ])->label($cOptFrm->getAttributeLabel('shedule_twfhr'), [
                                                    'class' => 'f-label f-label-lh20'
                                                ])
                                            ?>
                                            
                                            <div class="f-block">
                                                <?= $form->field($cOptFrm, 'shedule_every_day', [
                                                        'options' => ['class' => 'f-block f-block-inline f-block-top f-block-nm'],
                                                        'checkboxTemplate' => "{input}\n{label}"
                                                    ])->checkbox([
                                                        'class' => 'f-checkbox'
                                                    ])->label($cOptFrm->getAttributeLabel('shedule_every_day'), [
                                                        'class' => 'f-label f-label-lh20'
                                                    ])
                                                ?>
                                                
                                                <div class="f-block f-block-inline f-block-nm" id="shedule_days" <?= $company->getShedule()->isEveryDay() == 1 ? 'style="display: none;"' : '' ?>>
                                                    <ul class="week">
                                                        <li>
                                                            <?= $form->field($cOptFrm, 'shedule_mon', [
                                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm'],
                                                                    'checkboxTemplate' => "{input}\n{label}"
                                                                ])->checkbox([
                                                                    'class' => 'f-checkbox'
                                                                ])->label($cOptFrm->getAttributeLabel('shedule_mon'), [
                                                                    'class' => 'f-label f-label-lh20'
                                                                ])
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?= $form->field($cOptFrm, 'shedule_tue', [
                                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm'],
                                                                    'checkboxTemplate' => "{input}\n{label}"
                                                                ])->checkbox([
                                                                    'class' => 'f-checkbox'
                                                                ])->label($cOptFrm->getAttributeLabel('shedule_tue'), [
                                                                    'class' => 'f-label f-label-lh20'
                                                                ])
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?= $form->field($cOptFrm, 'shedule_wed', [
                                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm'],
                                                                    'checkboxTemplate' => "{input}\n{label}"
                                                                ])->checkbox([
                                                                    'class' => 'f-checkbox'
                                                                ])->label($cOptFrm->getAttributeLabel('shedule_wed'), [
                                                                    'class' => 'f-label f-label-lh20'
                                                                ])
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?= $form->field($cOptFrm, 'shedule_thu', [
                                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm'],
                                                                    'checkboxTemplate' => "{input}\n{label}"
                                                                ])->checkbox([
                                                                    'class' => 'f-checkbox'
                                                                ])->label($cOptFrm->getAttributeLabel('shedule_thu'), [
                                                                    'class' => 'f-label f-label-lh20'
                                                                ])
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?= $form->field($cOptFrm, 'shedule_fri', [
                                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm'],
                                                                    'checkboxTemplate' => "{input}\n{label}"
                                                                ])->checkbox([
                                                                    'class' => 'f-checkbox'
                                                                ])->label($cOptFrm->getAttributeLabel('shedule_fri'), [
                                                                    'class' => 'f-label f-label-lh20'
                                                                ])
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?= $form->field($cOptFrm, 'shedule_sat', [
                                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm'],
                                                                    'checkboxTemplate' => "{input}\n{label}"
                                                                ])->checkbox([
                                                                    'class' => 'f-checkbox'
                                                                ])->label($cOptFrm->getAttributeLabel('shedule_sat'), [
                                                                    'class' => 'f-label f-label-lh20'
                                                                ])
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?= $form->field($cOptFrm, 'shedule_sun', [
                                                                    'options' => ['class' => 'f-block f-block-inline f-block-nm'],
                                                                    'checkboxTemplate' => "{input}\n{label}"
                                                                ])->checkbox([
                                                                    'class' => 'f-checkbox'
                                                                ])->label($cOptFrm->getAttributeLabel('shedule_sun'), [
                                                                    'class' => 'f-label f-label-lh20'
                                                                ])
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="f-block">
                                            <div class="f-block" id="shedule_clock" <?= $company->twenty_four_hours ? 'style="display: none"' : '' ?>>
                                                <div class="f-block f-block-inline f-block-nm f-block-w">
                                                    <span class="period-caption">с</span>
                                                    
                                                    <div class="counter">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-hours">
                                                            <img src="<?= Url::to("/images/dial-hours.png") ?>" alt="" style="top: <?= -25 * $cOptFrm->b_hour ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                        <?= $form->field($cOptFrm, 'b_hour', ['options' => ['class' => 'f-block'], 'template' => "{input}\n"])->hiddenInput()->label(false) ?>
                                                    </div>
                                                    
                                                    <div class="counter counter_m">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-minutes">
                                                            <img src="<?= Url::to("/images/dial-minutes.png") ?>" alt="" style="top: <?= -25 * (int) floor($cOptFrm->b_minute /15) ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                        <?= $form->field($cOptFrm, 'b_minute', ['options' => ['class' => 'f-block'], 'template' => "{input}\n"])->hiddenInput()->label(false) ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="f-block f-block-inline f-block-nm f-block-w">
                                                    <span class="period-caption">до</span>
                                                    
                                                    <div class="counter">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-hours">
                                                            <img src="<?= Url::to("/images/dial-hours.png") ?>" alt="" style="top: <?= -25 * $cOptFrm->e_hour ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                        <?= $form->field($cOptFrm, 'e_hour', ['options' => ['class' => 'f-block'], 'template' => "{input}\n"])->hiddenInput()->label(false) ?>
                                                    </div>
                                                    
                                                    <div class="counter counter_m">
                                                        <span class="cntr-arrow-up"></span>
                                                        <span class="cntr-nums cntr-minutes">
                                                            <img src="<?= Url::to("/images/dial-minutes.png") ?>" alt="" style="top: <?= -25 * (int) floor($cOptFrm->e_minute / 15) ?>px;">
                                                        </span>
                                                        <span class="cntr-arrow-down"></span>
                                                        <?= $form->field($cOptFrm, 'e_minute', ['options' => ['class' => 'f-block'], 'template' => "{input}\n"])->hiddenInput()->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <?= $form->field($cOptFrm, 'company_phone', [
                                                'options' => ['class' => 'f-block']
                                            ])->textInput([
                                                'class' => 'form-control f-control', 'placeholder' => '+7 (_ _ _) _ _ _-_ _-_ _'
                                            ])->label($cOptFrm->getAttributeLabel('company_phone'), [
                                                'class' => 'f-label'
                                            ])
                                        ?>
                    
                                        <div class="f-block f-block-ta">
                                            <?= Html::submitButton('Сохранить', ['class' => 'f-button f-submit', 'id' => 'of-submit']) ?>
                                        </div>
                                    
                                    <?php ActiveForm::end(); ?>
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

