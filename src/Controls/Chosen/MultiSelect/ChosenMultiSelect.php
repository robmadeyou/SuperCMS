<?php

namespace SuperCMS\Controls\Chosen\MultiSelect;

use SuperCMS\Controls\Chosen\Dropdown\ChosenDropdown;

class ChosenMultiSelect extends ChosenDropdown
{
    public function __construct($name = "")
    {
        parent::__construct($name);

        $this->addCssClassNames('chosen-select');
    }

    protected function getViewClass()
    {
        return ChosenMultiSelectView::class;
    }
}
