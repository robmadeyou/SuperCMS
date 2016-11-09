<?php

namespace SuperCMS\Layouts;

class AdminLoginLayout extends AdminLayout
{
    protected function printPageHeading()
    {
        ?>
        <div class="login-page">
        <?php
    }

    protected function printTail()
    {
        ?>
        </div>
        <?php
    }
}