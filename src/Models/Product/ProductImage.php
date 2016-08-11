<?php
namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $ProductImageID Repository field
 * @property int $ProductID Repository field
 * @property string $ImagePath Repository field
 * @property-read Product $Product Relationship
 */
class ProductImage extends Model
{
    protected function createSchema()
    {
        $model = new MySqlModelSchema('tblProductImage');

        $model->addColumn(
            new AutoIncrementColumn('ProductImageID'),
            new ForeignKeyColumn('ProductID'),
            new StringColumn('ImagePath', 255)
        );

        return $model;
    }
}
