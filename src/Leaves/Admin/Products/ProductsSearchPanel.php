<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\SearchPanel\Leaves\SearchPanel;
use Rhubarb\Stem\Filters\Contains;
use Rhubarb\Stem\Filters\Group;

class ProductsSearchPanel extends SearchPanel
{
    protected function createSearchControls()
    {
        $name = new TextBox('Name');

        return [
            $name
        ];
    }

    public function populateFilterGroup(Group $filterGroup)
    {
        $name = $this->model->getSearchValue("Name", false);
        if ($name) {
            $filterGroup->addFilters(new Contains('Name', $name));
        }
    }
}
