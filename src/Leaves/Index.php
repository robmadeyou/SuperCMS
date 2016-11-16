<?php

namespace SuperCMS\Leaves;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class Index extends Leaf
{
    protected function getViewClass()
    {
        return IndexView::class;
    }

    protected function createModel()
    {
        return new LeafModel();
    }
}
