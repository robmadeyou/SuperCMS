<?php

namespace SuperCMS\Email;

class RegisterEmail extends SBaseEmail
{
    public function getHtml()
    {
        return <<<HTML
Thanks for registering.
HTML;
    }
}
