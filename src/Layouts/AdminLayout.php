<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Crown\Request\Request;
use SebastianBergmann\CodeCoverage\Report\Html\HTMLTest;

class AdminLayout extends SuperCMSDefaultLayout
{
    public function __construct()
    {
        parent::__construct();

        ResourceLoader::loadResource('/static/css/admin.css');
    }

    protected function printPageHeading()
    {
        $sideNavs = [
            [
                '/admin/dashboard/'      => 'Dashboard',
                '/admin/products/'       => 'Products',
                '/admin/categories/'     => 'Categories',
                '/admin/shipping-types/' => 'Shipping Types',
                '/admin/coupons/'        => 'Coupons',
            ]
        ];

        ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="/logout/">Logout</a></li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <?php
                    $current = Request::current();
                    foreach ($sideNavs as $groups) {
                        print '<ul class="nav nav-sidebar">';
                        foreach ($groups as $url => $name) {
                            $class = '';
                            if (strpos($current->uri, $url) === 0) {
                                $class = 'class="active"';
                            }
                            print <<<HTML
                        <li $class><a href="$url">$name</a></li>
HTML;
                        }
                        print '</ul>';
                    }
                    ?>
                </div>
                <?php

                parent::printPageHeading();

                ?>
            </div>
        </div>
        <div id="content">
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="loading-overlay"></div>
        <?php
    }

    protected function printTail()
    {
        print '</div></div>';
        parent::printTail();
    }
}
