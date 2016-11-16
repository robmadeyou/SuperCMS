<?php

namespace SuperCMS\Controls\DateRangePicker;

use Rhubarb\Leaf\Controls\Common\DateTime\Date;
use Rhubarb\Leaf\Controls\Common\DateTime\DateModel;

class DateRangePickerModel extends DateModel
{
    public $startDate;
    public $endDate;

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = "startDate";
        $properties[] = "endDate";

        return $properties;
    }
}
