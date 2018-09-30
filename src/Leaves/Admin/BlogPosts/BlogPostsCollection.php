<?php

namespace SuperCMS\Leaves\Admin\BlogPosts;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Leaves\Leaf;

class BlogPostsCollection extends ModelBoundLeaf
{
    /** @var BlogPostsCollectionModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return BlogPostsCollectionView::class;
    }

    protected function createModel()
    {
        return new BlogPostsCollectionModel();
    }
}
