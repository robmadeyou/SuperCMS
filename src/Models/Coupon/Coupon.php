<?php

namespace SuperCMS\Models\Coupon;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\DateColumn;
use Rhubarb\Stem\Schema\Columns\DecimalColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

class Coupon extends Model
{
    protected function createSchema()
    {
        $schema = new MySqlModelSchema('tblCoupon');
        $schema->addColumn(
            new AutoIncrementColumn('CouponID'),
            new StringColumn('Code', 5),
            new DecimalColumn('Discount'),
            new DateColumn('ValidFrom'),
            new DateColumn('ValidTo')
        );

        return $schema;
    }

    public function getFormattedDiscount()
    {
        return ($this->Discount ? : '0') . '%';
    }
}
