<?php

namespace SuperCMS\Leaves\Admin\Dashboard;

use Rhubarb\Leaf\Views\View;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\Not;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductImage;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Models\Shopping\Order;

class AdminDashboardView extends View
{
    protected function printViewContent()
    {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <?php
            $numberOfOrdersPending = Order::find(new Equals('Status', Order::STATUS_PENDING))->count();
            $this->printPanel(
                $numberOfOrdersPending,
                'Orders Pending!',
                '/admin/orders/',
                $numberOfOrdersPending == 0 ? 'green' : 'red',
                'shopping-cart'
            );

            $numberOfOrdersInProgress = Order::find(new Equals('Status', Order::STATUS_IN_PROGRESS))->count();
            $this->printPanel(
                $numberOfOrdersInProgress,
                'Orders In Progress!',
                '/admin/orders/',
                $numberOfOrdersInProgress == 0 ? 'green' : 'red',
                'shopping-cart'
            );

            $numberOfProductsWithoutImages = Product::find()->intersectWith(
                ProductVariation::find()->intersectWith(ProductImage::find(new Not(new Equals('ImagePath', ''))), 'ProductVariationID', 'ProductVariationID'),
                'ProductID',
                'ProductID'
            )->count();

            $totalProducts = Product::find()->count();
            $this->printPanel(
                $totalProducts - $numberOfProductsWithoutImages,
                'Missing Images!',
                '/admin/products/',
                'primary',
                'picture-o'
            );
            ?>
        </div>
        <?php
    }

    protected function printPanel( $count, $event, $link = '', $colour = 'primary', $icon = '' )
    {
        ?>
        <div class="col-lg-3 col-md-6">
            <a href="<?= $link ?>">
                <div class="c-d-panel panel panel-<?= $colour ?>">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-<?= $icon ?> fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $count ?></div>
                                <div><?= $event ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <?php
    }
}
