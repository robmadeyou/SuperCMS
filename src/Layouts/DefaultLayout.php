<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Category;

class DefaultLayout extends SuperCMSDefaultLayout
{
    public function __construct()
    {
        parent::__construct();

        ResourceLoader::loadResource("/files/css/base.css");
    }

    protected function printPageHeading()
    {
        ?>
        <div class="row body">
            <div class="col-md-10 col-md-offset-1 content">
                <div id="top-banner">
                    <div class="top-banner-bottom-buttons">
                        <? $this->printBannerButtons() ?>
                    </div>
                    <div class="banner-border"></div>
                </div>
                <div class="category-list">
                    <? $this->printCategoryMenu() ?>
                </div>
                <div id="content">
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
        <div id="tail">

        </div>
        <?php
    }
}
