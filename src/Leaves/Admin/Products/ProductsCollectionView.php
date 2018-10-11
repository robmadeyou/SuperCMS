<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Table\Leaves\Table;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Product;
use SuperCMS\Views\SuperCMSCollectionView;

class ProductsCollectionView extends SuperCMSCollectionView
{
    protected function getTitle()
    {
        return 'Products';
    }

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $table = new Table(Product::find()->filter(new Equals('Visible', true)), 50, 'Products'),
            $search = new ProductsSearchPanel('SearchPanel')
        );

        $table->addCssClassNames('table', 'table-striped', 'table-bordered', 'table-hover');
        $table->columns = [
            '' => '<img src="{DefaultImage}" width="64" height="64"/>',
            'Product Name' => 'Name',
            'Category' => '<a href="/admin/categories/{CategoryID}/">{Category.Name}</a>',
            'Live',
            ' ' => '<a href="{ProductID}/edit/" class="btn btn-default go"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>',
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
        print '<a href="add/" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add a Product</a>';
    }
}
