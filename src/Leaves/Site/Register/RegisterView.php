<?php

namespace SuperCMS\Leaves\Site\Register;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Views\View;

class RegisterView extends View
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $settings = HtmlPageSettings::singleton();
        $settings->pageTitle = 'Register now!';

        $this->registerSubLeaf(
            new TextBox('Username'),
            new TextBox('Email')
        );
    }
}
