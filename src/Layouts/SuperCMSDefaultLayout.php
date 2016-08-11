<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;

class SuperCMSDefaultLayout extends BaseLayout
{
    function __construct()
    {
        ResourceLoader::loadResource("/static/css/bootstrap.min.css");
    }
}