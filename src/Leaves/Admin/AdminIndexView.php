<?php

namespace SuperCMS\Leaves\Admin;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Views\View;

class AdminIndexView extends View
{
    protected function createSubLeaves()
    {
        throw new ForceResponseException(new RedirectResponse('/admin/dashboard/'));
    }
}
