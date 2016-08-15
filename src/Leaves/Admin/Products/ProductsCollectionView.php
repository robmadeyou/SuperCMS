<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Models\Product\Product;
use SuperCMS\Views\SuperCMSCollectionView;

class ProductsCollectionView extends SuperCMSCollectionView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $table = new Table(Product::find(), 50, 'Products'),
            $search = new ProductsSearchPanel('SearchPanel')
        );

        $table->addCssClassNames('table', 'table-striped');
        $table->columns = [
            'Name',
            'Cost',
            'AmountAvailable',
            '' => '<a href="{ProductID}/edit/" class="btn btn-default">Edit</a>',
        ];

        $search->bindEventsWith($table);
    }

    public function printBody()
    {
        print $this->leaves['Products'];
    }

    protected function printSearchPanel()
    {
        print $this->leaves['SearchPanel'];
    }

    protected function printRightButtons()
    {
        print '<a href="add/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add a Product</a>';
    }
}
