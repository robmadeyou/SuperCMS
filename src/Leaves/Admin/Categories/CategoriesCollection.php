<?php

namespace SuperCMS\Leaves\Admin\Categories;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;

class CategoriesCollection extends ModelBoundLeaf
{
    protected function getViewClass()
    {
        return CategoriesCollectionView::class;
    }

    protected function createModel()
    {
        $model = new CategoriesCollectionModel();
        return $model;
    }
}
