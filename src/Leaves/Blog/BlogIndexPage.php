<?php

namespace SuperCMS\Leaves\Blog;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class BlogIndexPage extends Leaf
{

    protected function getViewClass()
    {
        return BlogIndexPageView::class;
    }

    protected function createModel()
    {
        return new LeafModel();
    }
}
