<?php

namespace SuperCMS\Leaves\Site\Product;

use SuperCMS\Leaves\Site\Search\SearchLeaf;

class ProductCollection extends SearchLeaf
{
    protected function getViewClass()
    {
        return ProductCollectionView::class;
    }
}
