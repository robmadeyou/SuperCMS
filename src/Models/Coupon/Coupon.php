<?php

namespace SuperCMS\Models\Coupon;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\DateColumn;
use Rhubarb\Stem\Schema\Columns\DecimalColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $CouponID Repository field
 * @property string $Code Repository field
 * @property float $Discount Repository field
 * @property \Rhubarb\Crown\DateTime\RhubarbDate $ValidFrom Repository field
 * @property \Rhubarb\Crown\DateTime\RhubarbDate $ValidTo Repository field
 * @property-read mixed $FormattedDiscount {@link getFormattedDiscount()}
 */
class Coupon extends Model
{
    const VERSION = 1;

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
