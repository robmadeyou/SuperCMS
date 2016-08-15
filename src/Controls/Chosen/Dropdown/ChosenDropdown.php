<?php

namespace SuperCMS\Controls\Chosen\Dropdown;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;

class ChosenDropdown extends DropDown
{
    protected function getViewClass()
    {
        return ChosenDropdownView::class;
    }
}
