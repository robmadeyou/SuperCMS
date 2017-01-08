<?php

namespace SuperCMS\Leaves\Admin\Categories\Hierarchy;

use Rhubarb\Leaf\Leaves\Leaf;

class Hierarchy extends Leaf
{
    protected function getViewClass()
    {
        return HierarchyView::class;
    }

    protected function createModel()
    {
        return new HierarchyModel();
    }
}