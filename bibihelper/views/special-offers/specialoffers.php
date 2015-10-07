<?php

/* @var $this yii\web\View */

use app\assets\SpecialOffersAsset;
use yii\helpers\Url;

SpecialOffersAsset::register($this);

$this->title = 'BibiHelper: Все акции';
$this->params['page'] = 'index';
$this->params['user']['email'] = $user->email;
 
$spOffsCount = (int) count($spOffs) / 2 + 1;

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

<div class="container-fluid special-offers-header">
    <div class="row">
        <div class="container">
            <div class="row">
                <span class="special-offers-header-title">Доступные акции</span>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid main">
    <div class="row allspoff">
        <div class="allspoff-arrow allspoff-arrow-up-na" id="arrow-up"></div>
        
        <div class="container-fluid">
            <div class="row allspoff-slider">
                <ul class="allspoff-viewport" data-item="0">
                    <?php for ($i = 0; i < spOffsCount; $i += 2): ?>
                        <?php if ($spOffs[$i] !== null): ?>
                            <li class="allspoff-item">
                                <?php if ($spOffs[$i] !== null): ?>
                                    <div class="spoff-item">
                                        <div class="spoff-title">
                                            <span class="spoff-title-text">$spOffs[$i]->company->name</span>
                                        </div>
                                        <div class="spoff-image">
                                            <a href="#" title="" class="slider-href" data-cid="<?= $spOffs[$i]->company_id ?>">
                                                <img src="<?= Url::to($spOffs[$i]->file->getFileFullName('/images/slide-1.png')) ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="spoff-descr">
                                            <span class="spoff-descr-text"><?= $spOffs[$i]->comment ?></span>
                                            <span class="spoff-descr-period"><?= $spOffs[$i]->getPeriod() ?></span>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <?php if ($spOffs[$i + 1] !== null): ?>
                                    <div class="spoff-item">
                                        <div class="spoff-title">
                                            <span class="spoff-title-text">$spOffs[$i + 1]->company->name</span>
                                        </div>
                                        <div class="spoff-image">
                                            <a href="#" title="" class="slider-href" data-cid="<?= $spOffs[$i + 1]->company_id ?>">
                                                <img src="<?= Url::to($spOffs[$i + 1]->file->getFileFullName('/images/slide-1.png')) ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="spoff-descr">
                                            <span class="spoff-descr-text"><?= $spOffs[$i + 1]->comment ?></span>
                                            <span class="spoff-descr-period"><?= $spOffs[$i + 1]->getPeriod() ?></span>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </li>
                        <?php endif ?>
                    <?php endfor ?>
                </ul>
            </div>
        </div>

        <div class="allspoff-arrow allspoff-arrow-down" id="arrow-down"></div>
    </div>
</div>


