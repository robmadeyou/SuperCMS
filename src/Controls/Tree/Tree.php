<?php

namespace SuperCMS\Controls\Tree;

use Rhubarb\Leaf\Leaves\Controls\Control;

class Tree extends Control
{
    protected function getViewClass()
    {
        return TreeView::class;
    }
}
