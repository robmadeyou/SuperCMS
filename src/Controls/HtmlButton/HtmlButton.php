<?php

namespace SuperCMS\Controls\HtmlButton;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;

class HtmlButton extends Button
{
    protected function getViewClass()
    {
        return HtmlButtonView::class;
    }
}
