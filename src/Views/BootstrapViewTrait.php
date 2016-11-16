<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;
use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Leaves\Leaf;

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

    protected function printFieldset($title, $items)
    {
        ?>
        <form>
            <?php
            print $title;
            foreach ($items as $label => $item) {
                $label = !is_numeric($label) ? $label : $item;
                $itemObject = $this->leaves[ $item ];
                $form = <<<HTML
                    <div class="form-group">
                        <label>{$label}</label>
                        {$itemObject}
                    </div>
HTML;
                if (isset($itemObject->error) && $itemObject->error == true) {
                    $form = '<div class="has-error">' . $form . '</div>';
                }
                print $form;
            }
            ?>
        </form>
        <?php
    }
}
