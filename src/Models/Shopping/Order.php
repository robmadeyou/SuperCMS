<?php

namespace SuperCMS\Models\Shopping;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\Not;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\DateTimeColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 *
 *
 * @property int $OrderID Repository field
 * @property int $BasketID Repository field
 * @property-read OrderItem[]|\Rhubarb\Stem\Collections\RepositoryCollection $OrderItems Relationship
 * @property-read Basket $Basket Relationship
 * @property string $StripeToken Repository field
 * @property string $ClientIP Repository field
 * @property RhubarbDateTime $DateOrdered Repository field
 * @property string $Status Repository field
 * @property-read mixed $OrderItemStatus {@link getOrderItemStatus()}
 * @property string $UniqueReference Repository field
 */
class Order extends Model
{
    const VERSION = 1;

    const STATUS_PENDING = 'Pending';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_DISPATCHED = 'Dispatched';

    const STATUS_LIST = [
        self::STATUS_PENDING,
        self::STATUS_IN_PROGRESS,
        self::STATUS_DISPATCHED,
    ];

    protected function createSchema()
    {
        $schema = new ModelSchema('tblOrder');

        $schema->addColumn(
            new AutoIncrementColumn('OrderID'),
            new ForeignKeyColumn('BasketID'),
            new StringColumn('StripeToken', 150),
            new StringColumn('ClientIP', '16'),
            new DateTimeColumn('DateOrdered'),
            new MySqlEnumColumn('Status', self::STATUS_PENDING, self::STATUS_LIST),
            new StringColumn('UniqueReference', 40)
        );

        $schema->labelColumnName = 'OrderID';

        return $schema;
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord()) {
            $this->DateOrdered = new RhubarbDateTime('now');
            $this->UniqueReference = sha1($this->DateOrdered);
        }
    }

    public function getOrderItemStatus()
    {
        $total = $this->OrderItems->count();
        $left = $this->OrderItems->filter(new Not(new Equals('Status', OrderItem::STATUS_DISPATCHED)))->count();
        return $total - $left . '/' . $total;
    }

    public function checkUpdateStatus()
    {
        $status = '';
        foreach ($this->OrderItems as $orderItem) {
            if (!$status) {
                $status = $orderItem->Status;
            }

            if ($status != $orderItem->Status) {
                return;
            }
        }

        $this->Status = $status;
        $this->save();
    }
}
