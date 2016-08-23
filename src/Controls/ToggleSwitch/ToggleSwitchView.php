<?php

namespace SuperCMS\Controls\ToggleSwitch;

use Rhubarb\Leaf\Controls\Common\Checkbox\CheckboxView;

class ToggleSwitchView extends CheckboxView
{
    protected function printViewContent()
    {
        ?>
        <label class="switch">
            <?= parent::printViewContent();?>
            <div class="slider"></div>
        </label>
        <?php
    }

}
