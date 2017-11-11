<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Leaf\Crud\UrlHandlers\CrudUrlHandler;

class AdminCrudUrlHandler extends CrudUrlHandler
{
    use AdminUrlTrait;

    public function generateResponseForRequest($request = null)
    {
        $this->hasPermission();
        $this->registerLayouts();

        return parent::generateResponseForRequest($request);
    }
}
