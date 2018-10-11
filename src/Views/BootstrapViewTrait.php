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
        //TODO remove all bootstrapping of inputs. This shouldn't be done like this.
    }

    protected function printFieldset($title, $items)
    {
        //TODO fix this mess
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
