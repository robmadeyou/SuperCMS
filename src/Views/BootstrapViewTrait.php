<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;
use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;

trait BootstrapViewTrait
{
    protected function bootstrapInputs()
    {
        foreach ($this->leaves as $leaf) {
            if ($leaf instanceof Button) {
                $leaf->addCssClassNames('btn');
            } else if ($leaf instanceof TextBox) {
                $leaf->addCssClassNames('form-control');
            } else if ($leaf instanceof Checkbox) {
                $leaf->addCssClassNames('checkbox');
            } else if ($leaf instanceof DropDown) {
                $leaf->addCssClassNames('form-control');
            }
        }
    }
}
