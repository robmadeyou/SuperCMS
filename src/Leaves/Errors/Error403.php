<?php

namespace SuperCMS\Leaves\Errors;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class Error403 extends Leaf
{
    protected function getViewClass()
    {
        return Error403View::class;
    }

    protected function createModel()
    {
        return new LeafModel();
    }
}
