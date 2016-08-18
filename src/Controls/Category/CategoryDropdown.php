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

        if ($filters) {
            $collection = Category::find($filters);
        } else {
            $collection = Category::find();
        }

        $categories = [[0, 'None']];
        foreach ($collection as $category) {
            $categories[] = [$category->UniqueIdentifier, $category->Name];
        }

        $this->setSelectionItems($categories);
    }
}
