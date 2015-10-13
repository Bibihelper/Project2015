<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\IndexAsset;

IndexAsset::register($this);

$this->title = 'BibiHelper';
$this->params['page'] = 'index';
$this->params['user'] = $user;
$this->params['company'] = $user->company;
$this->params['city'] = $city;

?>

<?= $this->render('//dialogs.php', [
        'regFrm' => $regFrm,
        'logFrm' => $logFrm,
        'rstFrm' => $rstFrm,
    ]);
?>
    
<div class="container main">
    <div class="row">
        
        <div class="register-response">
            <span class="register-message"><?= $msg ?></span>
        </div>
        
        <div id="map"></div>
        
        <div class="search search-simple">
            <div class="search-headline"></div>
            
            <div class="search-form">
                <div class="f-group">
                    <span class="f-caption">Марка</span>
                    <div class="btn-group">
                        <button type="button" class="form-control btn dropdown-toggle f-list-button f-dropdown brand" data-id="0" data-toggle="dropdown">
                            <span class="f-button-caption">
                                <span class="f-button-text">&nbsp;</span>
                                <span class="caret f-button-caret f-button-caret-blue"></span>
                            </span>
                        </button>
                        <ul class="dropdown-menu f-list search-list">
                            <?php foreach ($brand as $brnd): ?>
                                <li data-id="<?= $brnd->id ?>"><a href="#" title=""><?= $brnd->name ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>                                                                                               
                </div>

                <div class="f-group">
                    <span class="f-caption">Вид работы</span>
                    <div class="btn-group">
                        <button type="button" class="form-control btn dropdown-toggle f-list-button f-dropdown wtype" data-id="0" data-toggle="dropdown">
                            <span class="f-button-caption">
                                <span class="f-button-text">&nbsp;</span>
                                <span class="caret f-button-caret f-button-caret-blue"></span>
                            </span>
                        </button>
                        <ul class="dropdown-menu f-list search-list">
                            <?php foreach ($category as $ctg): ?>
                                <li class="search-item-group disabled" data-category-id="<?= $ctg->id ?>"><span><?= $ctg->name ?></span></li>
                                <?php foreach ($ctg->service as $srv): ?>
                                    <li data-id="<?= $srv->id ?>"><a href="#" title=""><?= $srv->name ?></a></li>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </ul>
                    </div>                                                                                                                               
                </div>

                <div class="f-group">
                    <input type="checkbox" class="f-checkbox f-twfhr" id="twfhr-checkbox-1" checked="checked">
                    <label for="twfhr-checkbox-1" class="f-caption">Круглосуточно</label>
                </div>

                <div class="f-group">
                    <a href="#" title="" class="search-text-button" id="search-ext-button">Расширенный поиск</a>
                </div>

                <div class="f-group">
                    <button type="button" class="btn f-button search-button">Подобрать</button>
                </div>
            </div>
        </div>
        
        <div class="search search-ext" style="display: none;">
            <div class="search-headline"></div>
            
            <div class="search-form">
                <div class="f-group">
                    <span class="f-caption">Марка</span>
                    <div class="btn-group">
                        <button type="button" class="form-control btn dropdown-toggle f-list-button f-dropdown brand" data-id="0" data-toggle="dropdown">
                            <span class="f-button-caption">
                                <span class="f-button-text">&nbsp;</span>
                                <span class="caret f-button-caret f-button-caret-blue"></span>
                            </span>
                        </button>
                        <ul class="dropdown-menu f-list search-list">
                            <?php foreach ($brand as $brnd): ?>
                                <li data-id="<?= $brnd->id ?>"><a href="#" title=""><?= $brnd->name ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>                                                                                               
                </div>
                    
                <div class="f-group">
                    <span class="f-caption">Вид работы</span>
                    <div class="btn-group">
                        <button type="button" class="form-control btn dropdown-toggle f-list-button f-dropdown wtype" data-id="0" data-toggle="dropdown">
                            <span class="f-button-caption">
                                <span class="f-button-text">&nbsp;</span>
                                <span class="caret f-button-caret f-button-caret-blue"></span>
                            </span>
                        </button>
                        <ul class="dropdown-menu f-list search-list">
                            <?php foreach ($category as $ctg): ?>
                                <li class="search-item-group disabled" data-category-id="<?= $ctg->id ?>"><span><?= $ctg->name ?></span></li>
                                <?php foreach ($ctg->service as $srv): ?>
                                    <li data-id="<?= $srv->id ?>"><a href="#" title=""><?= $srv->name ?></a></li>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </ul>
                    </div>                                                                                                                               
                </div>
                    
                <div class="f-group">
                    <span class="f-caption">Район</span>
                    <div class="btn-group">
                        <button type="button" class="form-control btn dropdown-toggle f-list-button f-dropdown company-district" data-id="0" data-toggle="dropdown">
                            <span class="f-button-caption">
                                <span class="f-button-text">&nbsp;</span>
                                <span class="caret f-button-caret f-button-caret-blue"></span>
                            </span>
                        </button>
                        <ul class="dropdown-menu f-list search-list">
                            <?php foreach ($distr as $d): ?>
                                <li data-id="<?= $d->district ?>"><a href="#" title=""><?= $d->district ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>                                                                                                                               
                </div>
                    
               <div class="f-group">
                    <span class="f-caption">Названиее автосервиса</span>
                    <div class="input-group">
                        <input type="text" class="form-control search-edit company-name">
                    </div>                                                                                                                               
                </div>
                    
                <div class="f-group">
                    <span class="f-caption">Адрес</span>
                    <div class="input-group">
                        <input type="text" class="form-control search-edit company-address">
                    </div>                                                                                                                               
                </div>
                    
                <div class="f-group">
                    <input type="checkbox" class="f-checkbox f-twfhr" id="twfhr-checkbox-2" checked="checked">
                    <label for="twfhr-checkbox-2" class="f-caption">Круглосуточно</label>
                </div>

                <div class="f-group">
                    <a href="#" title="" class="search-text-button" id="search-simple-button">Свернуть</a>
                </div>

                <div class="f-group">
                    <button type="button" class="btn f-button search-button">Подобрать</button>
                </div>
            </div>
        </div>
        
        <div class="search search-results" style="display: none;">
            <div class="search-headline"></div>
            
            <div class="srchres-header">
                <a href="#" title="" class="srchres-header-title">Уточнить параметры поиска</a>
            </div>
            
            <div class="srchres-amount">
                <span class="srchres-amount-text">Найдено <span id="srchres-counter">0</span> автосервисов</span>
            </div>
            
            <div class="srlist-arrow srlist-arrow-up-na" id="srlist-arrow-u"></div>
            
            <ul class="srlist-tmpl" style="display: none;">
                <li class="srlist-item">
                    <a href="#" title="" class="srlist-ittl"></a>
                    <span class="srlist-iinf sr-address"></span>
                    <span class="srlist-iinf sr-shedule"></span>
                    <span class="srlist-iinf sr-phone"></span>
                        <a href="#" title="" class="srlist-iptr sr-mapptr" data-latitude="63.31268278" data-longitude="103.42773438"></a>
                    <a href="javascript::void(0)" title="" class="srlist-ispo"></a>
                    <span class="srlist-itwh"></span>
                </li>
            </ul>
            
            <div class="srlist-viewport">
                <ul class="srlist"></ul>
            </div>
        
            <div class="srlist-arrow srlist-arrow-down" id="srlist-arrow-d"></div>
        </div>
    </div>
</div>

<div class="container-fluid icons">
    <div class="row">
        <div class="container">
            <div class="row">
                <ul class="icons-list">
                    <li class="icons-list-item"><img src="<?= Url::to('/images/pointer-red.png') ?>" alt=""> - официальный диллер</li>
                    <li class="icons-list-item"><img src="<?= Url::to('/images/pointer-blue.png') ?>" alt=""> - универсальный автосервис</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid special-offers-header">
    <div class="row">
        <div class="container">
            <div class="row">
                <span class="special-offers-header-title">Специальные предложения</span>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid special-offers">       
    <div class="row">
            
        <div class="container">
            <div class="row slider-row slider-row-top">
            
                <ul class="slider-viewport">
                    <?php if ($spOffs !== false): ?>
                        <?php foreach ($spOffs as $spOff): ?>
                            <li class="slider-col"><div class="slider-col-header"><?= Html::encode($spOff->company->name) ?></div></li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 3; $i++): ?> 
                            <li class="slider-col"><div class="slider-col-header">Ультра сервис</div></li>
                            <li class="slider-col"><div class="slider-col-header">Сервис-X</div></li>
                            <li class="slider-col"><div class="slider-col-header">Ультра сервис</div></li>
                        <?php endfor ?>
                    <?php endif ?>
                </ul>
            
            </div>
        </div>
        
        <div class="container">
            <div class="row slider-row slider-row-middle">
            
                <ul class="slider-viewport" data-current="0">
                    <?php if ($spOffs !== false): ?>
                        <?php foreach ($spOffs as $spOff): ?>
                            <li class="slider-col">
                                <a href="<?= Url::to('/?cardid=' . $spOff->company_id) ?>" title="" class="slider-href" data-cid="<?= $spOff->company_id ?>">
                                    <img src="<?= Url::to($spOff->file->getFileFullName('/images/slide-1.png')) ?>" alt="">
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            
                            <?php for ($j = 1; $j <= 3; $j++): ?>
                                <li class="slider-col">
                                    <a href="#" title="">
                                        <img src="<?= Url::to('/images/slide-' . $j . '.png') ?>" alt="">
                                    </a>
                                </li>
                            <?php endfor ?>
                                
                        <?php endfor ?>
                    <?php endif ?>
                </ul>

                <div class="slider-arrow slider-arrow-left" ></div>
                <div class="slider-arrow slider-arrow-right"></div>
                
            </div>
        </div>
                    
        <div class="container">
            <div class="row slider-row slider-row-bottom">
            
                <ul class="slider-viewport">
                    <?php if ($spOffs !== false): ?>
                        <?php foreach ($spOffs as $spOff): ?>
                            <li class="slider-col">
                                <div class="slider-col-footer">
                                    <span class="special-offer-comment"><?= Html::encode($spOff->comment) ?></span>
                                    <span class="special-offer-period"><?= $spOff->getPeriod() ?></span>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <li class="slider-col">
                                <div class="slider-col-footer">Скидка 20% на замену масла плюс мойка за полцены!<br>С 20 августа по 20 сентября</div>
                            </li>
                            <li class="slider-col">
                                <div class="slider-col-footer">Скидка 20% на замену масла плюс мойка за полцены!<br>С 20 августа по 20 сентября</div>
                            </li>
                            <li class="slider-col">
                                <div class="slider-col-footer">Скидка 20% на замену масла плюс мойка за полцены!<br>С 20 августа по 20 сентября</div>
                            </li>
                        <?php endfor ?>
                    <?php endif ?>
                </ul>
                
            </div>
        </div>               
                            
    </div>
</div>

<div class="container-fluid all-special-offers">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="all-special-offers-block">
                    <button type="button" class="btn f-button f-submit special-offers-button">Смотреть все акции</button>
                </div>
            </div>
        </div>       
    </div>
</div>
            

