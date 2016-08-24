<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class ProductCollection extends ModelBoundLeaf
{
    protected function getViewClass()
    {
        return ProductCollectionView::class;
    }

    protected function createModel()
    {
        return new LeafModel();
    }
}
