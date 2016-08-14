<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Leaves\Leaf;

class ProductsCollection extends Leaf
{
    protected function getViewClass()
    {
        return ProductsCollectionView::class;
    }

    protected function createModel()
    {
        $model = new ProductsCollectionModel();
        return $model;
    }
}
