<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;

class SuperCMSDefaultLayout extends BaseLayout
{
    public function __construct()
    {
        ResourceLoader::loadResource("/static/css/bootstrap.min.css");
        ResourceLoader::loadResource("/static/css/general.css");
        ResourceLoader::loadResource("/static/css/daterangepicker.min.css");
        ResourceLoader::loadResource("/static/css/font-awesome.min.css");
    }
}
