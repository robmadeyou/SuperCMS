<?php

namespace SuperCMS\Leaves\Site\Register;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class Register extends Leaf
{
    protected function getViewClass()
    {
        return RegisterView::class;
    }

    protected function createModel()
    {
        return new LeafModel();
    }
}
