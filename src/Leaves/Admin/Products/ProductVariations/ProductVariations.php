<?php

namespace SuperCMS\Leaves\Admin\Products\ProductVariations;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class ProductVariations extends Leaf
{
    protected function createModel()
    {
        return new ProductVariationsModel();
    }

    protected function getViewClass()
    {
        return ProductVariationsView::class;
    }
}
