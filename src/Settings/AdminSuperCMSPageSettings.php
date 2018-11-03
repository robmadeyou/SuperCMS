<?php

namespace SuperCMS\Settings;

use Rhubarb\Crown\Settings\HtmlPageSettings;

class AdminSuperCMSPageSettings extends HtmlPageSettings
{
    private $actionButtons = [];

    public $requiresAddButton = false;
    public $addButtonLink = './add/';

    public $titleLink = '/admin/';

    /**
     * With the idea that the toolbar might not just contain Links. Plan is also to add interactive buttons
     * @param $html
     */
    public function addActionButton($html)
    {
        $this->actionButtons[] = $html;
    }

    public function getActionButtonsHTML()
    {
        $buttons = '';

        foreach($this->actionButtons as $actionButton) {
            $buttons .= $actionButton;
        }

        return <<<HTML
    {$buttons}
HTML;
    }
}
