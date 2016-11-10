<?php

namespace SuperCMS\Models\Shopping;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\ModelSchema;
use SuperCMS\SuperCMS;

/**
 *
 *
 * @property int $BasketItemID Repository field
 * @property int $ProductVariationID Repository field
 * @property int $BasketID Repository field
 * @property int $Quantity Repository field
 * @property-read \SuperCMS\Models\Product\ProductVariation $ProductVariation Relationship
 * @property-read Basket $Basket Relationship
 */
class BasketItem extends Model
{
    protected function createSchema()
    {
        $schema = new ModelSchema('tblBasketItem');

        $schema->addColumn(
            new AutoIncrementColumn('BasketItemID'),
            new ForeignKeyColumn('ProductVariationID'),
            new ForeignKeyColumn('BasketID'),
            new IntegerColumn('Quantity')
        );

        return $schema;
    }

    public function getTotalCost()
    {
        return SuperCMS::$currencySymbol . number_format($this->Quantity * $this->ProductVariation->Price, 2);
    }
}
