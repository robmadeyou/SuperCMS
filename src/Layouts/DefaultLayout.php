<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use SuperCMS\Controls\GlobalBasket\GlobalBasket;
use SuperCMS\Settings\SuperCmsPageSettings;

class DefaultLayout extends SuperCMSDefaultLayout
{
    public function __construct()
    {
        parent::__construct();

        ResourceLoader::loadResource("/files/css/base.css");
    }

    protected function printPageHeading()
    {;
        ?>
        <?php
        ?>
        <div class="row body">
            <div class="col-md-10 col-md-offset-1">
                <div class="c-supertop">
                    <?php $this->printNavigationItems() ?>
                    <?php $this->printBasket(); ?>
                </div>
                <div class="content">
                    <?php
                        $this->printTopBanner();
                    ?>
                    <div class="category-list">
                        <? $this->printCategoryMenu() ?>
                    </div>
                    <div id="content">
        <?php
    }

    protected function printNavigationItems()
    {
        ?>
        <?php
    }

    protected function printTopBanner()
    {
        $settings = SuperCmsPageSettings::singleton();
        if (!$settings->hideBanner) {
            ?>
            <div id="top-banner">
                <div class="top-banner-bottom-buttons">
                    <? $this->printBannerButtons() ?>
                </div>
            </div>
            <?php
        }
    }

    protected function printBasket()
    {
        ?>
        <div id="c-global-basket">
            <?= GlobalBasket::getInstance()->getOnlyHTML() ?>
        </div>
        <div class="clearfix"></div>
        <?php
    }

    protected function printCategoryMenu()
    {
        ?>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                ?>
            </ul>
        </div>
        <?php
    }

    protected function printBannerButtons()
    {
    }

    protected function printTail()
    {
        parent::printTail();

        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="tail">

        </div>
        <?php
    }
}
