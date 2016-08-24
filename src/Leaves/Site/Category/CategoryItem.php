<?php

namespace SuperCMS\Leaves\Site\Category;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;

class CategoryItem extends ModelBoundLeaf
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
