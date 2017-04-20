<?php

namespace SuperCMS\Leaves\Site\Search;

use Daisys\Views\DaisyDefaultView;
use Rhubarb\Crown\Settings\HtmlPageSettings;
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
        $settings = HtmlPageSettings::singleton();
        $settings->pageTitle = 'Searching for Products';
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new ProductListTable($this->model->getProductCollection(), 50, 'ProductList')
        );
    }

    protected function printViewContent()
    {
        parent::printViewContent();

        $amount = $this->model->getProductCollection()->count();

        $this->printBreadcrumbs();
        ?>
        <h3 class="c-title">Found <strong><?=$amount?> </strong> <?= $amount == 1 ? 'item' : 'items' ?>.</h3>
        <div class="row">
            <div class="col-sm-12">
                <?php $this->printProducts()?>
            </div>
        </div>
        <?php
    }

    function getBreadcrumbItems():array
    {
        $breadCrumbs = [
            'Home' => '/'
        ];

        $categories = [];
        if ($this->model->restModel && $this->model->restModel instanceof Category) {
            $currentCategory = $this->model->restModel;

            $categories[$currentCategory->Name] = $currentCategory->getPublicUrl();
            while ($currentCategory->ParentCategoryID) {
                $currentCategory = $currentCategory->ParentCategory;
                $categories[$currentCategory->Name] = $currentCategory->getPublicUrl();
            }
        }

        if (!empty($categories)) {
            foreach(array_reverse($categories, true) as $key => $value) {
                $breadCrumbs[$key] = $value;
            }
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
