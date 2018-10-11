<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Crown\Request\Request;
use SuperCMS\Models\Notification\Notification;
use SuperCMS\Settings\AdminSuperCMSPageSettings;use SuperCMS\Settings\SuperCmsPageSettings;use SuperCMS\Settings\SuperCMSSettings;

class AdminLayout extends SuperCMSDefaultLayout
{
    public function __construct()
    {
        parent::__construct();

        ResourceLoader::loadResource('/files/css/admin.css');
    }

    protected function printPageHeading()
    {
        $settings = SuperCMSSettings::singleton();
        $htmlPageSettings = AdminSuperCMSPageSettings::singleton();

        $sideNavs = [
            [
                '/admin/dashboard/' => '<i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span>',
                '/admin/orders/' => '<i class="fa fa-flag" aria-hidden="true"></i> <span>Orders</span>',
                '/admin/products/' => '<i class="fa fa-shopping-basket" aria-hidden="true"></i> <span>Products</span>',
                '/admin/categories/' => '<i class="fa fa-folder-open-o" aria-hidden="true"></i> <span>Categories</span>',
                '/admin/coupons/' => '<i class="fa fa-ticket" aria-hidden="true"></i> <span>Vouchers</span>',
            ]
        ];

        if ($settings->enableBlog) {
            $sideNavs[0]['/admin/blog/'] = '<i class="fa fa-book" aria-hidden="true"></i> <span>Blog</span>';
        }

        $sideNavs[0]['/admin/settings/'] = '<i class="fa fa-gear fa-fw"></i> <span>Settings</span>';

        //todo: make admin href be dependant on the database
        ?>
        <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-top-content">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
                if ($htmlPageSettings->requiresAddButton) {
                    print "<a href='{$htmlPageSettings->addButtonLink}' class='c-button mc-green --square'><i class='fa fa-plus fa-fw'></i></a>";
                }
                ?>
                <a class="navbar-brand" href="/admin/"><?= $htmlPageSettings->pageTitle ?></a>
                <?= $htmlPageSettings->getActionButtonsHTML() ?>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php
                        $notifications = Notification::getUnreadNotifications();
                        if ($notifications->count()) {
                            foreach($notifications as $notification) {
                                $this->printNotificationListItem(
                                    $notification->getNotificationIcon(),
                                    $notification->Note,
                                    $notification->getLink(),
                                    $notification->getTimeAgo()
                                );
                            }
                        } else {
                            ?>
                            <li>
                                <p class="text-center">
                                    <strong>No new Notifications</strong>
                                </p>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="/admin/settings/"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/admin/login/?logout=1"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            </div>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse collapse" style="height: 1px;">
                    <ul class="nav" id="side-menu">
                        <?php
                        $current = Request::current();
                        foreach ($sideNavs as $groups) {
                            foreach ($groups as $url => $name) {
                                $class = '';
                                if (strpos($current->uri, $url) === 0) {
                                    $class = 'class="active"';
                                }
                                print <<<HTML
                                    <li $class><a href="$url">$name</a></li>
HTML;
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
        <?php
    }

    protected function printTail()
    {
        print '</div></div>';
        parent::printTail();
    }

    protected function printNotificationListItem($icon, $message, $link, $timeAgo)
    {
        ?>
        <li>
            <a href="<?= $link ?>">
                <div>
                    <?= $icon ?> <?= $message ?>
                    <span class="pull-right text-muted small"><?= $timeAgo ?></span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <?php
    }
}
