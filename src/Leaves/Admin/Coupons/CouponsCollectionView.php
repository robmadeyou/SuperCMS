<?php

namespace SuperCMS\Leaves\Admin\Coupons;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Models\Coupon\Coupon;
use SuperCMS\Views\SuperCMSCollectionView;

class CouponsCollectionView extends SuperCMSCollectionView
{
    protected function printTitle()
    {
        print 'Coupons';
    }

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $table = new Table(Coupon::find(), 20, 'CouponTable')
        );

        $table->setNoDataHtml('No coupons created yet.');

        $table->addCssClassNames('table', 'table-striped', 'table-bordered', 'table-hover');
        $table->addCssClassNames('table table-striped');
        $table->columns = [
            'Code',
            'Discount' => '{FormattedDiscount}',
            'ValidFrom',
            'ValidTo',
            'Edit' => '<a href="{CouponID}/edit/" class="btn btn-default">Edit</a>'
        ];
    }

    public function printBody()
    {
        print $this->leaves['CouponTable'];
    }

    protected function printRightButtons()
    {
        print '<a href="add/" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add a Coupon</a>';
    }
}
