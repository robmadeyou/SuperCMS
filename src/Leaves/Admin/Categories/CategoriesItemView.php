<?php

namespace SuperCMS\Leaves\Admin\Categories;

use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Views\SuperCMSCrudView;

class CategoriesItemView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'Name',
            new CategoryDropdown('ParentCategoryID')
        );

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('', [
            'Name',
            'Parent Category' => 'ParentCategoryID',
        ]);
    }
}
