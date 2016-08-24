<?php

namespace SuperCMS\Leaves\Errors;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class Error404 extends Leaf
{
    protected function getViewClass()
    {
        return Error404View::class;
    }

    protected function createModel()
    {
        return new LeafModel();
    }
}
