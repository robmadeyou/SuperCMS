<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;

class ProductsCollection extends ModelBoundLeaf
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
