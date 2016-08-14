<?php

namespace SuperCMS\Leaves\Admin\Categories;

use SuperCMS\Controls\Chosen\Dropdown\ChosenDropdown;
use SuperCMS\Models\Product\Category;
use SuperCMS\Views\SuperCMSCrudView;

class CategoriesItemView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'Name',
            $categories = new ChosenDropdown('ParentCategoryID')
        );

        $categoryArray = [];
        foreach (Category::find() as $category) {
            $categoryArray[] = [$category->CategoryID, $category->Name];
        }
        $categories->setSelectionItems($categoryArray);

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