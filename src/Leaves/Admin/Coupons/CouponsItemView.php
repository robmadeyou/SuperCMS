<?php

namespace SuperCMS\Leaves\Admin\Coupons;

use SuperCMS\Controls\DateRangePicker\DateRangePicker;
use SuperCMS\Views\SuperCMSCrudView;

class CouponsItemView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'Code',
            'Discount',
            $dateRangePicker = new DateRangePicker('DateRange')
        );

        if (!$this->model->restModel->isNewRecord()) {
            $dateRangePicker->setStartDate($this->model->restModel->ValidFrom);
            $dateRangePicker->setEndDate($this->model->restModel->ValidTo);
        }

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('',
            [
                'Code',
                'Discount Percent' => 'Discount',
                'Valid Range' => 'DateRange',
            ]);
    }

    protected function printLeftButtons()
    {
        $url = $this->model->restModel->isNewRecord() ? '../' : '../../' ;
        print '<a href="' . $url . '" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>';
    }
}
