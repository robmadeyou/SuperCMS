<?php

namespace SuperCMS\Leaves\Site\Search;

use Daisys\Views\DaisyDefaultView;
use SuperCMS\Leaves\Site\Search\ProductListTable\ProductListTable;
use SuperCMS\Models\Product\Category;
use SuperCMS\Session\SuperCMSSession;
use SuperCMS\Views\BreadcrumbTrait;

class SearchView extends DaisyDefaultView
{
    use BreadcrumbTrait;

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

        $this->printBreadcrumbs();
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

    function getBreadcrumbItems():array
    {
        $session = SuperCMSSession::singleton();

        $breadCrumbs = [
            'Home' => '/'
        ];

        if ($this->model->restModel && $this->model->restModel instanceof Category) {
            $breadCrumbs[$this->model->restModel->Name] = $this->model->restModel->getPublicUrl();
        }

        if ($session->searchQuery) {
            $breadCrumbs['Search: ' . $session->searchQuery] = '';
        }

        return $breadCrumbs;
    }

    protected function printFilters()
    {
    }

    protected function printProducts()
    {
        print $this->leaves['ProductList'];
    }
}
