<?php

namespace SuperCMS\Leaves\Admin\Categories\Hierarchy;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Controls\Tree\Tree;
use SuperCMS\Controls\Tree\TreeSchema;
use SuperCMS\Models\Product\Category;
use SuperCMS\Views\SuperCMSCrudView;

class HierarchyView extends SuperCMSCrudView
{
    /** @var HierarchyModel $model */
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $tree = new Tree('CategoryTree')
        );

        $tree->setData($this->convertToTree());

        $this->bootstrapInputs();
    }

    private function convertToTree($collection = null)
    {
        $treeObjects = [];

        if (!$collection) {
            $collection = Category::find(new Equals('ParentCategoryID', 0));
        }

        foreach ($collection as $category) {
            $object = new TreeSchema();
            $children = [];
            /** @var Category $category */
            if ($category->ChildCategories->count()) {
                $children = $this->convertToTree($category->ChildCategories);
            }

            $object->setData($category->Name, $category->UniqueIdentifier, $category->Image, false, false, true, $children);
            $treeObjects[] = $object;
        }

        return $treeObjects;
    }

    protected function printBody()
    {
        print $this->leaves['CategoryTree'];
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

    protected function printLeftButtons()
    {
        print '<a href="../" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>';
    }
}
