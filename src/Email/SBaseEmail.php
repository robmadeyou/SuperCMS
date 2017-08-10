<?php

namespace SuperCMS\Email;

use Rojr\Scaffold\Email\Templates\Emails\TemplatedEmail;

class SBaseEmail extends TemplatedEmail
{
    public static function isBase()
    {
        return true;
    }

    public static function getDefaultHtml()
    {
        return <<<HTML
        This is the base buddy boy!
        {ChildContent}
HTML;
    }
}
