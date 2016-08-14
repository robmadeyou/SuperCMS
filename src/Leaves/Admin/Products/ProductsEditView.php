<?php

namespace SuperCMS\Leaves\Admin\Products;

use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Views\SuperCMSCrudView;

class ProductsEditView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'Name',
            'Cost',
            'AmountAvailable',
            new CategoryDropdown('CategoryID')
        );

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('Cool',
            [
                'Name',
                'Cost',
                'AmountAvailable',
                'Category' => 'CategoryID'
            ]);
    }

    protected function printLeftButtons()
    {
        print '<a href="../../" class="btn btn-default">Back</a>';
    }
}