<?php

namespace SuperCMS\Leaves\Admin\Categories\Hierarchy;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Category;
use SuperCMS\Views\SuperCMSCrudView;

class HierarchyView extends SuperCMSCrudView
{
    /** @var HierarchyModel $model */
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printBaseCategories();
    }

    protected function printBaseCategories()
    {
        print '<div class="gridly">';
        foreach(Category::find(new Equals('ParentCategoryID', 0)) as $baseCategory) {
            print $this->getCategoryHTML($baseCategory);
        }
        print '</div>';
    }

    /**
     * @param Category $category
     *
     * @return string
     */
    protected function getCategoryHTML(Category $category)
    {
        $htmlString = '<div class="brick">' . $category->Name . '</div>';
        foreach($category->ChildCategories as $childCategory) {

        }
        return $htmlString;
    }

    protected function getTitle()
    {
        return 'Hierarchy';
    }

    protected function getViewBridgeName()
    {
        return 'HierarchyViewBridge';
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(
            __DIR__ . '/../../../../../static/js/jquery.js',
            __DIR__ . '/' . $this->getViewBridgeName() . '.js'
        );
    }
}
