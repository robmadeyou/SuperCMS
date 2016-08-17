<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\CommaSeparatedListColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\JsonColumn;
use Rhubarb\Stem\Schema\Columns\MoneyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $ProductID Repository field
 * @property string $Name Repository field
 * @property int $CategoryID Repository field
 * @property int $AmountAvailable Repository field
 * @property-read ProductImage[]|\Rhubarb\Stem\Collections\Collection $Images Relationship
 * @property-read Product $ParentCategory Relationship
 * @property-read Comment[]|\Rhubarb\Stem\Collections\Collection $Comments Relationship
 * @property-read \Rhubarb\Stem\Tests\unit\Fixtures\Category $Category Relationship
 * @property string $Description Repository field
 * @property string[] $Keywords Repository field
 * @property \stdClass $Properties Repository field
 * @property-read Product[]|\Rhubarb\Stem\Collections\Collection $ChildProduct Relationship
 * @property-read ProductVariation[]|\Rhubarb\Stem\Collections\Collection $Variations Relationship
 * @property-read mixed $DefaultProductVariation {@link getDefaultProductVariation()}
 */
class Product extends Model
{
    protected function createSchema()
    {
        $schema = new MySqlModelSchema('tblProduct');

        $schema->addColumn(
            new AutoIncrementColumn('ProductID'),
            new StringColumn('Name', 140),
            new MySqlMediumTextColumn('Description'),
            new CommaSeparatedListColumn('Keywords'),
            new ForeignKeyColumn('CategoryID'),
            new IntegerColumn('AmountAvailable'),
            new JsonColumn('Properties')
        );

        return $schema;
    }

    public function getDefaultProductVariation()
    {
        if ($this->Variations->count() == 0) {
            $v = new ProductVariation();
            $v->ProductID = $this->UniqueIdentifier;
            $v->save();
            return $v;
        } else {
            return $this->Variations[0];
        }
    }
}
