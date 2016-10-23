<?php
namespace SuperCMS\Models\Product;

use Rhubarb\Leaf\Controls\Common\FileUpload\UploadedFileDetails;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $ProductImageID Repository field
 * @property int $ProductVariationID Repository field
 * @property string $ImagePath Repository field
 * @property-read ProductVariation $ProductVariation Relationship
 * @property int $Priority Repository field
 */
class ProductImage extends Model
{
    protected function createSchema()
    {
        $model = new MySqlModelSchema('tblProductImage');

        $model->addColumn(
            new AutoIncrementColumn('ProductImageID'),
            new ForeignKeyColumn('ProductVariationID'),
            new StringColumn('ImagePath', 255),
            new IntegerColumn('Priority')
        );

        return $model;
    }

    public static function createImageForProduct(ProductVariation $product, UploadedFileDetails $uploadData = null)
    {
        $obj = new self();
        $obj->ProductVariationID = $product->UniqueIdentifier;

        if ($uploadData) {
            $uploadPath = APPLICATION_ROOT_DIR . '/static/images/products/' . $product->ProductID . '/' . $product->UniqueIdentifier . '/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 777, true);
                chmod($uploadPath, 0777);
            }

            $finalLocation = $uploadPath . sha1($product->UniqueIdentifier) . '-' . $uploadData->originalFilename;
            rename($uploadData->tempFilename, $finalLocation);

            $obj->ImagePath = str_replace(APPLICATION_ROOT_DIR, '',realpath($finalLocation));
        }

        $obj->save();
    }
}
