<?php

namespace SuperCMS\Models\Shipping;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\MoneyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $ShippingTypeID Repository field
 * @property string $ShippingType Repository field
 * @property float $UK Repository field
 * @property float $NI Repository field
 * @property float $ROI Repository field
 * @property float $EU Repository field
 * @property float $W1 Repository field
 * @property float $W2 Repository field
 */
class ShippingType extends Model
{
    protected function createSchema()
    {
        $schema = new MySqlModelSchema('tblShippingType');

        $schema->addColumn(
            new AutoIncrementColumn('ShippingTypeID'),
            new StringColumn('ShippingType', 100),
            new MoneyColumn('UK'),
            new MoneyColumn('NI'),
            new MoneyColumn('ROI'),
            new MoneyColumn('EU'),
            new MoneyColumn('W1'),
            new MoneyColumn('W2')
        );

        $schema->labelColumnName = 'ShippingType';

        return $schema;
    }
}
