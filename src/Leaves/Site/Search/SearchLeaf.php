<?php

namespace SuperCMS\Leaves\Site\Search;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;

class  SearchLeaf extends ModelBoundLeaf
{
    protected function getViewClass()
    {
        return SearchView::class;
    }

    protected function createModel()
    {
        return new SearchModel();
    }
}
