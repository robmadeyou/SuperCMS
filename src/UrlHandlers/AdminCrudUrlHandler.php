<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Leaf\Crud\UrlHandlers\CrudUrlHandler;
use SuperCMS\Layouts\AdminLayout;

class AdminCrudUrlHandler extends CrudUrlHandler
{
    public function generateResponseForRequest($request = null)
    {
        LayoutModule::setLayoutClassName(AdminLayout::class);
        return parent::generateResponseForRequest($request);
    }
}
