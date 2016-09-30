<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;

class SuperCMSDefaultLayout extends BaseLayout
{
    public function __construct()
    {
        ResourceLoader::loadResource("/files/css/?p=bootstrap.min.css");
        ResourceLoader::loadResource("/files/css/?p=general.css");
        ResourceLoader::loadResource("/files/css/?p=daterangepicker.min.css");
        ResourceLoader::loadResource("/files/css/?p=font-awesome.min.css");
    }
}
