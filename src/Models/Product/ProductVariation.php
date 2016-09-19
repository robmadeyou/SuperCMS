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

    public function setName($name)
    {
        $this->modelData['Name'] = $name;

        $clean_name = strtr($name, [
            'Š' => 'S',
            'Ž' => 'Z',
            'š' => 's',
            'ž' => 'z',
            'Ÿ' => 'Y',
            'À' => 'A',
            '�?' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            '�?' => 'I',
            'Î' => 'I',
            '�?' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            '�?' => 'Y',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'ÿ' => 'y'
        ]);
        $clean_name = strtr($clean_name, ['Þ' => 'TH', 'þ' => 'th', '�?' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u']);
        $clean_name = preg_replace(['/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'], ['-', '-', '-'], $clean_name);
        $clean_name = preg_replace('/\-+/', '-', $clean_name);
        $this->SeoSafeName = $clean_name;
    }
}
