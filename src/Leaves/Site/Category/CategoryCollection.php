<?php

namespace SuperCMS\Leaves\Site\Category;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;

class CategoryCollection extends ModelBoundLeaf
{
    protected function getViewClass()
    {
        return CategoryCollectionView::class;
    }

    protected function createModel()
    {
        return new ModelBoundModel();
    }
}
