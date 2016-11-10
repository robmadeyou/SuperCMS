<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Crud\UrlHandlers\CrudUrlHandler;
use SuperCMS\Layouts\AdminLayout;
use SuperCMS\LoginProviders\AdminLoginProvider;
use SuperCMS\LoginProviders\SCmsLoginProvider;

class AdminCrudUrlHandler extends CrudUrlHandler
{
    public function generateResponseForRequest($request = null)
    {
        $loggedIn = AdminLoginProvider::getLoggedInUser();
        if ($loggedIn->RoleID != 2) {
            throw new ForceResponseException(new RedirectResponse('/403/'));
        }

        LayoutModule::setLayoutClassName(AdminLayout::class);

        return parent::generateResponseForRequest($request);
    }
}
