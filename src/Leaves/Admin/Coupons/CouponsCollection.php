<?php

namespace SuperCMS\Leaves\Admin\Coupons;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class CouponsCollection extends ModelBoundLeaf
{
    protected function getViewClass()
    {
        return CouponsCollectionView::class;
    }

    protected function createModel()
    {
        return new LeafModel();
    }
}
