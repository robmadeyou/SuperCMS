<?php

namespace SuperCMS\Leaves\Site\Search;

use Daisys\Views\DaisyDefaultView;
use SuperCMS\Leaves\Site\Search\ProductListTable\ProductListTable;

class SearchView extends DaisyDefaultView
{
    /** @var SearchModel */
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new ProductListTable($this->model->getProductCollection(), 20, 'ProductList')
        );
    }

    protected function printViewContent()
    {
        parent::printViewContent();

        $amount = $this->model->getProductCollection()->count();
        ?>
        <h3>Found <strong><?=$amount?> </strong> <?= $amount == 1 ? 'item' : 'items' ?>.</h3>
        <div class="row">
            <div class="col-sm-2">
                <?php $this->printFilters() ?>
            </div>
            <div class="col-sm-10">
                <?php $this->printProducts()?>
            </div>
        </div>
        <?php
    }

    protected function printFilters()
    {
    }

    protected function printProducts()
    {
        print $this->leaves['ProductList'];
    }
}
