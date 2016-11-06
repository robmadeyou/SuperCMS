<?php

namespace SuperCMS\Leaves\Site\Category;

use SuperCMS\Leaves\Site\Search\SearchModel;

class CategoryItemModel extends SearchModel
{
    public function getProductCollection()
    {
        return $this->restModel->Products;
    }
}
