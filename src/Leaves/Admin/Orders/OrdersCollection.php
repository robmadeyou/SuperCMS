<?php

namespace SuperCMS\Leaves\Admin\Orders;

use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;

class OrdersCollection extends CrudLeaf
{
    protected function getViewClass()
    {
        return OrdersCollectionView::class;
    }
}
