<?php

namespace SuperCMS\Leaves\Blog;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class BlogIndexPage extends ModelBoundLeaf
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
