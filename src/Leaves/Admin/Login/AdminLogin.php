<?php

namespace SuperCMS\Leaves\Admin\Login;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Scaffolds\Authentication\Leaves\Login;
use SuperCMS\Layouts\AdminLoginLayout;

class AdminLogin extends Login
{
    protected function getViewClass()
    {
        LayoutModule::setLayoutClassName(AdminLoginLayout::class);
        return AdminLoginView::class;
    }

    protected function onSuccess()
    {
        $request = Request::current();

        if ($request->get('rd')) {
            parent::onSuccess();
        } else {
            throw new ForceResponseException(new RedirectResponse('/admin/dashboard/'));
        }
    }

}
