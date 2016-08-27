<?php

namespace SuperCMS\Controls\DateRangePicker;

use Rhubarb\Crown\DateTime\RhubarbDate;
use Rhubarb\Leaf\Controls\Common\DateTime\Date;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;

class DateRangePicker extends Date
{
    protected function getViewClass()
    {
        return DateRangePickerView::class;
    }

    protected function createModel()
    {
        $model = new DateRangePickerModel();

        $model->startDate = date('d/m/Y');
        $model->endDate = date('d/m/Y');

        return $model;
    }

    public function setStartDate(RhubarbDate $date)
    {
        if ($date->format('Y')) {
            $this->model->startDate = $date->format('d/m/Y');
        }
    }

    public function setEndDate(RhubarbDate $date)
    {
        if ($date->format('Y')) {
            $this->model->endDate = $date->format('d/m/Y');
        }
    }
}
