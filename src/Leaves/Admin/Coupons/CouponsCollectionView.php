<?php

namespace SuperCMS\Leaves\Admin\Coupons;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Models\Coupon\Coupon;
use SuperCMS\Views\SuperCMSCollectionView;

class CouponsCollectionView extends SuperCMSCollectionView
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $table = new Table(Coupon::find(), 20, 'CouponTable')
        );

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
        print '<a href="add/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add a Coupon</a>';
    }
}
