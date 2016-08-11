<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\UrlHandlers\ClassMappedUrlHandler;
use SuperCMS\Layouts\AdminLayout;

class AdminClassMappedUrlHandler extends ClassMappedUrlHandler
{
    public function __construct($className, $children = [])
    {
        parent::__construct($className, $children);

        LayoutModule::setLayoutClassName(AdminLayout::class);
    }

}
