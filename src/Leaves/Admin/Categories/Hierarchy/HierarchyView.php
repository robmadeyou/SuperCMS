<?php

namespace SuperCMS\Leaves\Admin\Categories\Hierarchy;

use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Category;
use SuperCMS\Views\SuperCMSCrudView;

class HierarchyView extends SuperCMSCrudView
{
    /** @var HierarchyModel $model */
    protected $model;

    protected function printBody()
    {
    }

    protected function printBaseCategories()
    {
        foreach(Category::find(new Equals('ParentCategoryID', 0)) as $baseCategory) {

        }
    }

    /**
     * @param Category $category
     *
     * @return string
     */
    protected function getSubCategoryHTML(Category $category)
    {
        $htmlString = '';
        foreach($category->ChildCategories as $childCategory) {

        }
        return $htmlString;
    }

    protected function getTitle()
    {
    }
}
