<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;

class SuperCMSDefaultLayout extends BaseLayout
{
    public function __construct()
    {
        ResourceLoader::loadResource("https://code.jquery.com/jquery-2.2.4.min.js");
        ResourceLoader::loadResource("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");
        ResourceLoader::loadResource("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
        ResourceLoader::loadResource("/files/css/general.css");
        ResourceLoader::loadResource("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    }
    
    protected function printHead()
    {
        ?>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <?php
    }

    protected function printTail()
    {
        parent::printTail();
    }
}
