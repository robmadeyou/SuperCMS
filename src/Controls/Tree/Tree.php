<?php

namespace SuperCMS\Controls\Tree;

use Rhubarb\Leaf\Leaves\Controls\Control;

class Tree extends Control
{
    /** @var TreeModel $model */
    protected $model;

    protected function getViewClass()
    {
        return TreeView::class;
    }
}
