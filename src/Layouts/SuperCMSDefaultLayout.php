<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;

class SuperCMSDefaultLayout extends BaseLayout
{
    public function __construct()
    {
        ResourceLoader::loadResource("/files/css/bootstrap.min.css");
        ResourceLoader::loadResource("/files/css/general.css");
        ResourceLoader::loadResource("/files/css/daterangepicker.min.css");
        ResourceLoader::loadResource("/files/css/font-awesome.min.css");
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

        ?>


        <script type="text/javascript">

            !window.jQuery && document.write('<script src="/files/js/jquery.js"><\/script>');
            document.write('<script src="/files/js/bootstrap.min.js"><\/script>');
        </script>
        <?php
    }
}
