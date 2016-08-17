<?php

namespace SuperCMS\Controls\Chosen\MultiSelect;

use SuperCMS\Controls\Chosen\Dropdown\ChosenDropdownView;

class ChosenMultiSelectView extends ChosenDropdownView
{
    protected function printViewContent()
    {
        $name = $this->model->leafPath;

        if ($this->model->supportsMultipleSelection) {
            $name .= "[]";
        }

        ?>
    <select multiple name="<?= \htmlentities($name); ?>[]" id="<?= \htmlentities($name); ?>" tabindex="-1"
            leaf-name="<?= \htmlentities($this->model->leafName); ?>"<?= $this->model->getHtmlAttributes() . $this->model->getClassAttribute() ?>>
        <?php
        foreach ($this->model->selectionItems as $item) {
            $itemList = [$item];
            $isGroup = false;

            if (isset( $item->Children )) {
                $isGroup = true;
                $itemList = $item->Children;

                print "<optgroup label=\"" . htmlentities($item->label) . "\">";
            }

            foreach ($itemList as $subItem) {
                $value = $subItem->value;
                $text = $subItem->label;

                $selected = ( $this->isValueSelected($value) ) ? " selected=\"selected\"" : "";

                $data = json_encode($subItem);

                print "<option value=\"" . \htmlentities($value) . "\"" . $selected . " data-item=\"" . htmlentities(
                        $data
                    ) . "\">" . \htmlentities($text) . "</option>
";
            }

            if ($isGroup) {
                print "</optgroup>";
            }
        }
        ?>
        </select><?php
    }
}
