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
 */
class Product extends Model
{
    protected function createSchema()
    {
        $schema = new MySqlModelSchema('tblProduct');

        $schema->addColumn(
            new AutoIncrementColumn('ProductID'),
            new MySqlMediumTextColumn('Description'),
            new ForeignKeyColumn('CategoryID'),
            new CommaSeparatedListColumn('ShippingTypes'),
            new BooleanColumn('Live'),
            new BooleanColumn('Visible', false)
        );

        return $schema;
    }

    public function getDefaultProductVariation()
    {
        if ($this->isNewRecord()) {
            $this->save();
        }

        if ($this->Variations->count() == 0) {
            $v = new ProductVariation();
            $v->ProductID = $this->UniqueIdentifier;
            $v->save();
            return $v;
        } else {
            return $this->Variations[0];
        }
    }

    protected function afterSave()
    {
        parent::afterSave();

        if (!$this->Variations->count()) {
            $this->getDefaultProductVariation();
        }
    }

    public static function find(Filter ...$filters)
    {
        return parent::find(new AndGroup([new Equals('Visible', true), new AndGroup($filters)]));
    }
}
