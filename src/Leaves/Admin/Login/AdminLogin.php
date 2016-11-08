<?php

namespace SuperCMS\Leaves\Admin\Login;

use Rhubarb\Scaffolds\Authentication\Leaves\Login;

class AdminLogin extends Login
{
    protected function getViewClass()
    {
        return AdminLoginView::class;
    }
}
