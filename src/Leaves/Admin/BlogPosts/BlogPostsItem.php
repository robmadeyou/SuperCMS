<?php

namespace SuperCMS\Leaves\Admin\BlogPosts;

use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;

class BlogPostsItem extends CrudLeaf
{
    /** @var BlogPostsItemModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return BlogPostsItemView::class;
    }

    protected function createModel()
    {
        return new BlogPostsItemModel();
    }
}
