<?php

namespace SuperCMS\Email;

use Rojr\Scaffold\Email\Templates\Emails\TemplatedEmail;

class RegisterEmail extends TemplatedEmail
{
    public static function getDefaultHtml()
    {
        return <<<HTML
Thank you very much for registering!
HTML;

    }

    public static function isBase()
    {
        return false;
    }
}
