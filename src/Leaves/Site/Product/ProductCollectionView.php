<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;
use Rhubarb\Leaf\Table\Leaves\Table;
use Rhubarb\Leaf\Views\View;

class ProductCollectionView extends View
{
    /**
     * @var ModelBoundModel $model
     */
    protected $model;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $table = new Table($this->model->restCollection, 50, 'Products')
        );

        $table->addCssClassNames('table');
        $table->columns = [
            'Name',
        ];
    }

    protected function printViewContent()
    {
        print 'Product view';
        print $this->leaves['Products'];
    }
}
