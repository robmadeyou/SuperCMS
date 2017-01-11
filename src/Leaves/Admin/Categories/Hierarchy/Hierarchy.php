<?php

namespace SuperCMS\Leaves\Admin\Categories\Hierarchy;

use Rhubarb\Leaf\Leaves\Leaf;
use SuperCMS\Controls\Notification\NotificationPrint;
use SuperCMS\Models\Product\Category;

class Hierarchy extends Leaf
{
    /** @var HierarchyModel $model */
    protected $model;

    protected function getViewClass()
    {
        return HierarchyView::class;
    }

    protected function createModel()
    {
        return new HierarchyModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->saveHierarchyEvent->attachHandler(function($statuses) {
            $saveChild = function($statuses, $parentId = 0) use (&$saveChild){
                foreach($statuses as $status) {
                    $category = new Category($status[0]);
                    if ($parentId) {
                        $category->ParentCategoryID = $parentId;
                    } else {
                        $category->ParentCategoryID = 0;
                    }

                    if (!$status[0]) {
                        $category->Visible = true;
                    }
                    $category->Name = $status[2];
                    $category->save();

                    if (!empty($status[1])) {
                        $saveChild($status[1], $status[0]);
                    }
                }
            };

            $saveChild($statuses);
            print new NotificationPrint('Succesfully updated Category Hierarchy', NotificationPrint::SUCCESS);
        });
    }
}