<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\SearchPanel\Leaves\SearchPanel;
use Rhubarb\Stem\Filters\AnyWordsGroup;
use Rhubarb\Stem\Filters\Contains;
use Rhubarb\Stem\Filters\Group;
use SuperCMS\Views\SuperCMSSearchPanelView;

class ProductsSearchPanel extends SearchPanel
{
    protected function getViewClass()
    {
        return SuperCMSSearchPanelView::class;
    }

    protected function createSearchControls()
    {
        $name = new TextBox('Query');
        $name->addHtmlAttribute('size', 30);

        $live = new Checkbox('Live');
        $live->setLabel('Only live products');

        return [
            $name,
            $live
        ];
    }

    public function populateFilterGroup(Group $filterGroup)
    {
        $name = $this->model->getSearchValue("Query", false);
        if ($name) {
            $filterGroup->addFilters(new AnyWordsGroup(['Name'], $name));
        }

        $live = $this->model->getSearchValue('Live', false);
        if ($live) {
            $filterGroup->addFilters(new Contains('Live', $live));
        }
    }
}
