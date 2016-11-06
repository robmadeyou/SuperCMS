<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;
use SuperCMS\Leaves\Site\Search\SearchLeaf;

class ProductCollection extends SearchLeaf
{
    protected function getViewClass()
    {
        return ProductCollectionView::class;
    }

    protected function createModel()
    {
        return new ModelBoundModel();
    }
}
