<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Leaf\Table\Leaves\TableView;
use SuperCMS\Models\Shopping\BasketItem;

class BasketTableView extends TableView
{
    public function printViewContent()
    {
        $suppressPagerContent = false;

        if ($this->model->unsearchedHtml && !$this->model->searched) {
            print $this->model->unsearchedHtml;
            $suppressPagerContent = true;
        } elseif (count($this->model->collection) == 0 && $this->model->noDataHtml) {
            print $this->model->noDataHtml;
            $suppressPagerContent = true;
        }

        $this->leaves["EventPager"]->setNumberPerPage($this->model->pageSize);
        $this->leaves["EventPager"]->setCollection($this->model->collection);
        print $this->leaves["EventPager"];

        if ($suppressPagerContent) {
            return;
        }

        print '<div class="products-list">';
        foreach ($this->model->collection as $basketProduct) {
            /** @var BasketItem $basketProduct */
            print <<<HTML
            <div class="search-product basket-product row marginless">
            <div class="col-sm-3 product-image">
                <img src="{$basketProduct->ProductVariation->getPrimaryImage()}">
            </div>
            <div class="col-sm-6 product-description">
                <p class="product-title">{$basketProduct->ProductVariation->Name}</p>
                <p class="c-description">{$basketProduct->ProductVariation->Product->Description}</p>
            </div>
            <div class="col-sm-3 product-price">
                <div class="pull-right">
                    <a href="#">Remove</a><br>
                    <input size="5" type="text" value="{$basketProduct->Quantity}"><br>
                    <p class="product-cost pull-right">&pound{$basketProduct->ProductVariation->Price}</p>
                </div>
            </div>
        </div>
HTML;

        }
        print '</div>';

        $this->leaves["EventPager"]->printWithIndex("bottom");
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();

        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';

        return $package;
    }

    protected function getViewBridgeName()
    {
        return 'BasketTableViewBridge';
    }
}
