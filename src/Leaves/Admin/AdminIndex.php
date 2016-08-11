<?php

namespace SuperCMS\Leaves\Admin;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class AdminIndex extends Leaf
{
    protected function getViewClass()
    {
        return AdminIndexView::class;
    }

    protected function createModel()
    {
        $model = new LeafModel();
        return $model;
    }
}
