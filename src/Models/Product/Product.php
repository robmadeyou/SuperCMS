<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Filters\AndGroup;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\Filter;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\BooleanColumn;
use Rhubarb\Stem\Schema\Columns\CommaSeparatedListColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $ProductID Repository field
 * @property string $Description Repository field
 * @property int $CategoryID Repository field
 * @property string[] $ShippingTypes Repository field
 * @property bool $Live Repository field
 * @property bool $Visible Repository field
 * @property-read Product[]|\Rhubarb\Stem\Collections\RepositoryCollection $ChildProduct Relationship
 * @property-read Product $ParentCategory Relationship
 * @property-read Comment[]|\Rhubarb\Stem\Collections\RepositoryCollection $Comments Relationship
 * @property-read ProductVariation[]|\Rhubarb\Stem\Collections\RepositoryCollection $Variations Relationship
 * @property-read Category $Category Relationship
 * @property-read mixed $DefaultProductVariation {@link getDefaultProductVariation()}
 * @property string $Name Repository field
 * @property string[] $RelatedProductIDs Repository field
 */
class Product extends Model
{
    protected function createSchema()
    {
        $schema = new MySqlModelSchema('tblProduct');

        $schema->addColumn(
            new AutoIncrementColumn('ProductID'),
            new StringColumn('Name', 255),
            new MySqlMediumTextColumn('Description'),
            new ForeignKeyColumn('CategoryID'),
            new CommaSeparatedListColumn('ShippingTypes'),
            new BooleanColumn('Live'),
            new BooleanColumn('Visible', false),
            new CommaSeparatedListColumn('RelatedProductIDs', 500, [], true)
        );

        return $schema;
    }

    public function getDefaultProductVariation()
    {
        if ($this->isNewRecord()) {
            $this->save();
        }

        $variations = ProductVariation::find(new Equals('ProductID', $this->UniqueIdentifier));
        if ($variations->count() == 0) {
            $v = new ProductVariation();
            $v->ProductID = $this->UniqueIdentifier;
            $v->save();
            return $v;
        } else {
            return $variations[0];
        }
    }

    protected function afterSave()
    {
        parent::afterSave();

        if (!$this->Variations->count() && !isset($this->Importing)) {
            $this->getDefaultProductVariation();
        }
    }

    public static function find(Filter ...$filters)
    {
        return parent::find(new AndGroup([new Equals('Visible', true), new AndGroup($filters)]));
    }
}
