<?php

namespace SuperCMS\Controls\Category;

use Rhubarb\Stem\Filters\Filter;
use SuperCMS\Controls\Chosen\Dropdown\ChosenDropdown;
use SuperCMS\Models\Product\Category;

class CategoryDropdown extends ChosenDropdown
{
    public function __construct($name = "", Filter $filters = null)
    {
        parent::__construct($name);

        $categories = [];
        foreach (Category::find($filters) as $category) {
            $categories[] = [$category->UniqueIdentifier, $category->Name];
        }

        $this->setSelectionItems($categories);
    }

    protected function getViewClass()
    {
        return CategoryDropdownView::class;
    }
}
