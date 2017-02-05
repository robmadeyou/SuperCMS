<?php

namespace SuperCMS\Leaves\Site\Search\ProductListTable;

use Rhubarb\Leaf\Table\Leaves\TableView;
use SuperCMS\Models\Product\Product;

class ProductListTableView extends TableView
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
        foreach ($this->model->collection as $product) {
            /** @var Product $product */
            print <<<HTML
            <div class="search-product row marginless">
                <div class="col-sm-3 product-image">
                    <img src="{$product->getDefaultImage()}">
                </div>
                <div class="col-sm-6 product-description">
                    <p class="product-title">{$product->Name}</p>
                    <p class="c-description">{$product->Description}</p>
                </div>
                <div class="col-sm-3 product-price">
                        <p class="product-cost pull-right">&pound{$product->getDefaultProductVariation()->Price}</p>
                        <a href="{$product->getPublicUrl()}" class="button pull-right c-full-mobile">View</a>
                </div>
            </div>
HTML;

        }
        print '</div>';

        $this->leaves["EventPager"]->printWithIndex("bottom");
    }
}
