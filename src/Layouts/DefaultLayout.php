<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;

class DefaultLayout extends SuperCMSDefaultLayout
{
    public function __construct()
    {
        parent::__construct();

        ResourceLoader::loadResource("/static/css/base.css");
    }

    protected function printPageHeading()
    {
        ?>
        <div class="row body">
            <div class="col-md-10 col-md-offset-1 content">
                <div id="top-banner">
                    <div class="top-banner-bottom-buttons">
                        <div class="pull-left btn-group">
                            <a href="/" class="btn btn-default">Home</a>
                            <a href="/about-us/" class="btn btn-default round-right">About us</a>
                        </div>
                        <div class="pull-right btn-group">
                            <a href="/news/" class="btn btn-default round-left">Latest News</a>
                            <a href="/contact/" class="btn btn-default">Contact Us</a>
                        </div>
                    </div>
                    <div class="banner-border"></div>
                </div>
                <div id="content">
        <?php
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
