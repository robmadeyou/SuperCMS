<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\CommaSeparatedListColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\MoneyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $ProductID Repository field
 * @property int $ParentProductID Repository field
 * @property string $Name Repository field
 * @property float $Cost Repository field
 * @property int $CategoryID Repository field
 * @property int $AmountAvailable Repository field
 * @property-read ProductImage[]|\Rhubarb\Stem\Collections\Collection $Images Relationship
 * @property-read Product[]|\Rhubarb\Stem\Collections\Collection $ChildProduct Relationship
 * @property-read Product $ParentCategory Relationship
 * @property-read Comment[]|\Rhubarb\Stem\Collections\Collection $Comments Relationship
 * @property-read \Rhubarb\Stem\Tests\unit\Fixtures\Category $Category Relationship
 */
class Product extends Model
{
    protected function createSchema()
    {
        $schema = new MySqlModelSchema('tblProduct');

        $schema->addColumn(
            new AutoIncrementColumn('ProductID'),
            new ForeignKeyColumn('ParentProductID'),
            new StringColumn('Name', 140),
            new MySqlMediumTextColumn('Description'),
            new CommaSeparatedListColumn('Keywords'),
            new MoneyColumn('Cost'),
            new ForeignKeyColumn('CategoryID'),
            new IntegerColumn('AmountAvailable')
        );

        return $schema;
    }
}
