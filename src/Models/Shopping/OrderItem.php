<?php

namespace SuperCMS\Models\Shopping;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 *
 *
 * @property int $OrderItemID Repository field
 * @property int $OrderID Repository field
 * @property int $BasketItemID Repository field
 * @property string $Status Repository field
 * @property-read Order $Order Relationship
 * @property-read BasketItem $BasketItem Relationship
 */
class OrderItem extends Model
{
    const VERSION = 1;

    const STATUS_PENDING = 'Pending';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_DISPATCHED = 'Dispatched';

    protected function createSchema()
    {
        $schema = new ModelSchema('tblOrderItem');

        $schema->addColumn(
            new AutoIncrementColumn('OrderItemID'),
            new ForeignKeyColumn('OrderID'),
            new ForeignKeyColumn('BasketItemID'),
            new MySqlEnumColumn('Status', self::STATUS_PENDING, [self::STATUS_PENDING, self::STATUS_IN_PROGRESS, self::STATUS_DISPATCHED])
        );

        return $schema;
    }

    protected function afterSave()
    {
        $this->Order->checkUpdateStatus();
    }
}
