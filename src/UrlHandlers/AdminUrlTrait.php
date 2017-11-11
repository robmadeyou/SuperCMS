<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\LayoutProviders\LayoutProvider;
use SuperCMS\Layouts\AdminLayout;
use SuperCMS\Layouts\AdminLayoutProvider;
use SuperCMS\LoginProviders\AdminLoginProvider;

trait AdminUrlTrait
{
    protected function hasPermission()
    {
        $loggedIn = AdminLoginProvider::getLoggedInUser();
        if ($loggedIn->RoleID != 2) {
            throw new ForceResponseException(new RedirectResponse('/403/'));//TODO add custom error recording
        }
    }

    protected function registerLayouts()
    {
        LayoutModule::setLayoutClassName(AdminLayout::class);
        LayoutProvider::setProviderClassName(AdminLayoutProvider::class);
    }
}
