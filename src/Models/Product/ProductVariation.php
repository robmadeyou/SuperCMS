<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\JsonColumn;
use Rhubarb\Stem\Schema\Columns\MoneyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use SuperCMS\Exceptions\Models\Products\ProductMustHaveVariationException;


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
 * @property-read mixed $PrimaryImage {@link getPrimaryImage()}
 * @property-read mixed $PublicUrl {@link getPublicUrl()}
 * @property string $SeoSafeName Repository field
 */
class ProductVariation extends Model
{
    use SetUniqueNameTrait;

    const VERSION = 1;

    protected function createSchema()
    {
        $model = new MySqlModelSchema('tblProductVariation');

        $model->addColumn(
            new AutoIncrementColumn('ProductVariationID'),
            new StringColumn('Name', 255),
            new ForeignKeyColumn('ProductID'),
            new IntegerColumn('AmountAvailable'),
            new IntegerColumn('Quantity'),
            new MySqlMediumTextColumn('Description'),
            new JsonColumn('Properties'),
            new MoneyColumn('Price'),
            new IntegerColumn('Quantity'),
            new StringColumn('SeoSafeName', 255)
        );

        return $model;
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord()) {
            if (!$this->Name) {
                $this->Name = 'Unnamed Variation';
            }
        }
    }

    public function getPrimaryImage()
    {
        $image = $this->Images->addSort('Priority');
        if(sizeof($image) && $image[0]->ImagePath) {
            return $image[0]->ImagePath;
        }
        return '/static/images/noimage.png';
    }

    public function getPublicUrl()
    {
        return $this->Product->getPublicUrl() . '?v=' . $this->UniqueIdentifier;
    }

    public function delete()
    {
        if (!$this->isNewRecord()) {
            if ($this->Product->Variations->count() == 1) {
                throw new ProductMustHaveVariationException();
            }
        }
        parent::delete();
    }
}
