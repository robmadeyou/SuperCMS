<?php

namespace SuperCMS\Controls\Carousel;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;

class CarouselView extends View
{
    /**
     * @var CarouselModel $model
     */
    protected $model;

    protected function printViewContent()
    {
        ?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>

            <div class="carousel-inner" role="listbox">

                <?php
                $i = 0;
                foreach($this->model->sliderImages as $image) {
                    $this->printImage($image, $i == 0);
                    $i++;
                }
                ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
    }

    protected function printImage($image, $active = false)
    {
        $active = $active ? 'active' : '';
        print <<<HTML
        <div class="item {$active}">
            <img src="{$image}">
        </div>
HTML;
    }

    public function getDeploymentPackage()
    {
        $package = new LeafDeploymentPackage();
        $package->resourcesToDeploy[] = VENDOR_DIR . '/rojr/super-cms/static/js/jquery.js';
        $package->resourcesToDeploy[] = VENDOR_DIR . '/twbs/bootstrap/dist/js/bootstrap.min.js';
        $package->resourcesToDeploy[] = __DIR__ . '/CarouselViewBridge.js';
        return $package;
    }

    protected function getViewBridgeName()
    {
        return 'CarouselViewBridge';
    }
}
