<?php

namespace SuperCMS\Leaves\Errors;

use Rhubarb\Leaf\Views\View;

class Error404View extends View
{
    protected function printViewContent()
    {
        ?>
        <h1>404... Oops.</h1>
        <p>Looks like the content you are looking for is no longer.</p>
        <?php
    }
}
