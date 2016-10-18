<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\JsonColumn;
use Rhubarb\Stem\Schema\Columns\MoneyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;


/**
 *
 *
 * @property int $ProductVariationID Repository field
 * @property string $Name Repository field
 * @property int $ProductID Repository field
 * @property int $AmountAvailable Repository field
 * @property string $Description Repository field
 * @property \stdClass $Properties Repository field
 * @property float $Price Repository field
 * @property-read Product $Product Relationship
 * @property-read ProductImage[]|\Rhubarb\Stem\Collections\RepositoryCollection $Images Relationship
 * @property int $Quantity Repository field
 * @property-read \SuperCMS\Models\Shopping\BasketItem[]|\Rhubarb\Stem\Collections\RepositoryCollection $BasketItems Relationship
 */
class ProductVariation extends Model
{
    protected function createSchema()
    {
        $model = new MySqlModelSchema('tblProductVariation');

        $model->addColumn(
            new AutoIncrementColumn('ProductVariationID'),
            new StringColumn('Name', 50),
            new ForeignKeyColumn('ProductID'),
            new IntegerColumn('AmountAvailable'),
            new IntegerColumn('Quantity'),
            new MySqlMediumTextColumn('Description'),
            new JsonColumn('Properties'),
            new MoneyColumn('Price'),
            new IntegerColumn('Quantity')
        );

        return $model;
    }
}
