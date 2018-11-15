<?php

namespace SuperCMS\Leaves\Blog;

use Rhubarb\Leaf\Leaves\Leaf;

class BlogItem extends Leaf
{
    /** @var BlogItemModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return BlogItemView::class;
    }

    protected function createModel()
    {
        return new BlogItemModel();
    }
}
