<?php

namespace SuperCMS\Controls\ToggleSwitch;

use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;

class ToggleSwitch extends Checkbox
{
    protected function getViewClass()
    {
        return ToggleSwitchView::class;
    }
}
