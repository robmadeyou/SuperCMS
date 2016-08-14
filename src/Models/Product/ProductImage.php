<?php
namespace SuperCMS\Models\Product;

use Rhubarb\Leaf\Controls\Common\FileUpload\UploadedFileDetails;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int          $ProductImageID Repository field
 * @property int          $ProductID      Repository field
 * @property string       $ImagePath      Repository field
 * @property-read Product $Product        Relationship
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

    public static function createImageForProduct(Product $product, UploadedFileDetails $uploadData = null)
    {
        $obj = new self();
        $obj->ProductID = $product->UniqueIdentifier;

        if ($uploadData) {
            $uploadPath = __DIR__ . '/../../../static/images/products/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 777, true);
            }

            $finalLocation = $uploadPath . sha1($product->UniqueIdentifier) . '-'. $uploadData->originalFilename;
            rename($uploadData->tempFilename, $finalLocation);

            $obj->ImagePath = $finalLocation;
        }

        $obj->save();
    }
}
