<?php

namespace SuperCMS\Leaves\Admin\Dashboard;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class AdminDashboard extends Leaf
{
    protected function getViewClass()
    {
        return AdminDashboardView::class;
    }

    protected function createModel()
    {
        $model = new LeafModel();
        return $model;
    }
}
