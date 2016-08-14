<?php

namespace SuperCMS\Leaves\Admin\Categories;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Models\Product\Category;
use SuperCMS\Views\SuperCMSCollectionView;

class CategoriesCollectionView extends SuperCMSCollectionView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $table = new Table(Category::find(), 50, 'Categories')
        );

        $table->addCssClassNames('table', 'table-striped');
        $table->columns = [
            'Name',
            'Parent Category' => 'ParentCategory.Name',
            '' => '<a href="{CategoryID}/edit/" class="btn btn-default">Edit</a>'
        ];
    }

    protected function printRightButtons()
    {
        print '<a href="add/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add a Category</a>';
    }

    function printBody()
    {
        print $this->leaves['Categories'];
    }
}
