<?php

namespace SuperCMS\Controls\ToggleSwitch;

use Rhubarb\Leaf\Controls\Common\Checkbox\CheckboxView;

class ToggleSwitchView extends CheckboxView
{
    protected function printViewContent()
    {
        ?>
        <label class="switch">
            <?php
            $attributes = $this->getNameValueClassAndAttributeString(false);
            $attributes .= $this->model->value ? ' checked="checked"' : '';

            // include a hidden presence input, because on submit if the checkbox is unchecked it won't be included in the
            // POST data. The presence input can be used to detect that the input has been submitted and should be FALSE.
            $presence = $this->getPresenceInputName();
            print "<input type='checkbox' {$attributes}/><div class=\"slider\"></div><input type='hidden' name='{$presence}' value='0'>";
            ?>
        </label>
        <?php
    }

    /**
     * @return string
     */
    private function getPresenceInputName()
    {
        return "set_{$this->model->leafPath}_";
    }
}
