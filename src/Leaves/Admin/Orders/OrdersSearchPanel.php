<?php

namespace SuperCMS\Leaves\Admin\Orders;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\SearchPanel\Leaves\SearchPanel;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\Group;
use SuperCMS\Models\Shopping\Order;
use SuperCMS\Views\SuperCMSSearchPanelView;

class OrdersSearchPanel extends SearchPanel
{
    protected function getViewClass()
    {
        return SuperCMSSearchPanelView::class;
    }

    protected function createSearchControls()
    {
        $status = new DropDown('Status');

        $status->addCssClassNames('c-dropdown');
        $status->setSelectionItems(array_merge([['', 'Please Select']], Order::STATUS_LIST));
        $status->setLabel('Order Status');

        return [
            $status,
        ];
    }

    public function populateFilterGroup(Group $filterGroup)
    {
        $status = $this->model->getSearchValue("Status", false);
        if ($status) {
            $filterGroup->addFilters(new Equals('Status', $status));
        }
    }
}
