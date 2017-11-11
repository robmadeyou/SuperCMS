<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\UrlHandlers\ClassMappedUrlHandler;

class AdminClassMappedUrlHandler extends ClassMappedUrlHandler
{
    use AdminUrlTrait;

    public function generateResponseForRequest($request = null)
    {
        $this->hasPermission();
        $this->registerLayouts();

        return parent::generateResponseForRequest($request);
    }
}
