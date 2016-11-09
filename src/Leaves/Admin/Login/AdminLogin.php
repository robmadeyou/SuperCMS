<?php

namespace SuperCMS\Leaves\Admin\Login;

use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Scaffolds\Authentication\Leaves\Login;
use SuperCMS\Layouts\AdminLoginLayout;

class AdminLogin extends Login
{
    protected function getViewClass()
    {
        LayoutModule::setLayoutClassName(AdminLoginLayout::class);
        return AdminLoginView::class;
    }
}
