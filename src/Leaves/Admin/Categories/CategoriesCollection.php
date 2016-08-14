<?php

namespace SuperCMS\Leaves\Admin\Categories;

use Rhubarb\Leaf\Leaves\Leaf;

class CategoriesCollection extends Leaf
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
