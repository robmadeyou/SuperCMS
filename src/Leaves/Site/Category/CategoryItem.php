<?php

namespace SuperCMS\Leaves\Site\Category;

use SuperCMS\Leaves\Site\Search\SearchLeaf;

class CategoryItem extends SearchLeaf
{
    protected function getViewClass()
    {
        return CategoryItemView::class;
    }

    protected function createModel()
    {
        $model = new CategoryItemModel();

        return $model;
    }
}
