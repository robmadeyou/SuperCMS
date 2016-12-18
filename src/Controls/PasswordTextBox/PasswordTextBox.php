<?php

namespace SuperCMS\Controls\PasswordTextBox;

class PasswordTextBox extends \Rhubarb\Leaf\Controls\Common\Text\PasswordTextBox
{
    protected function getViewClass()
    {
        return PasswordTextBoxView::class;
    }
}
