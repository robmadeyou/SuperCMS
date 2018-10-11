<?php

namespace SuperCMS\Settings;

use Rhubarb\Crown\Settings\HtmlPageSettings;

class AdminSuperCMSPageSettings extends HtmlPageSettings
{
    private $actionButtons;

    public $requiresAddButton = false;
    public $addButtonLink = './add/';

    /**
     * With the idea that the toolbar might not just contain Links. Plan is also to add interactive
     * @param $html
     */
    public function addActionButton($html)
    {
        $this->actionButtons[] = $html;
    }

    public function getActionButtonsHTML()
    {
        return <<<HTML
<div class="c-menu-action-buttons">

</div>
HTML;
    }
}
