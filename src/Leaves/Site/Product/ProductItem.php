<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;

class ProductItem extends ModelBoundLeaf
{
    protected function getViewClass()
    {
        return ProductItemView::class;
    }

    protected function createModel()
    {
        return new ModelBoundModel();
    }
}
