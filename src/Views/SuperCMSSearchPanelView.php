<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;
use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Leaves\Controls\Control;
use Rhubarb\Leaf\SearchPanel\Leaves\SearchPanelView;

class SuperCMSSearchPanelView extends SearchPanelView
{
    use BootstrapViewTrait;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->bootstrapInputs();
    }

    protected function printViewContent()
    {
        print '<div class="c-search-panel">
                <div class="form-inline">';

        foreach ($this->model->searchControls as $control) {
            /** @var Control $control */
            if ($control instanceof Checkbox) {
                print '<div class="checkbox">';
                print '<label>' . $control . ' ' .  $control->getLabel() . '</label>';
                print '</div>';
            } else if ($control instanceof DropDown) {
                print '<div class="form-group">';
                print '<label>' . $control->getLabel() . ' ' . $control . '</label>';
                print '</div>';
            } else {
                $control->setPlaceholderText($control->getLabel());
                print '<div class="form-group">';
                print '<label class="sr-only" for="' . $control->getPath(). '">' . $control->getLabel() . '</label>';
                print $control;
                print '</div>';
            }
        }

        print '<span class="pull-right">' . $this->leaves["Search"] . '</span>';
        print '</div>
             </div>';
    }
}
