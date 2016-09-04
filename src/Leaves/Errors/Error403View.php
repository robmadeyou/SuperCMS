<?php

namespace SuperCMS\Leaves\Errors;

use Rhubarb\Leaf\Views\View;

class Error403View extends View
{
    protected function printViewContent()
    {
        ?>
        <h1>403... Oops.</h1>
        <p>Looks like you don't have the permissions to access this page.</p>
        <?php
    }
}
