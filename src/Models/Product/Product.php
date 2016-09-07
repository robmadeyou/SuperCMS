<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\BooleanColumn;
use Rhubarb\Stem\Schema\Columns\CommaSeparatedListColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\JsonColumn;
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
 * @property string[] $ShippingTypes Repository field
 * @property bool $Live Repository field
 * @property string $SeoSafeName Repository field
 */
class Product extends Model
{
    protected function createSchema()
    {
        $schema = new MySqlModelSchema('tblProduct');

        $schema->addColumn(
            new AutoIncrementColumn('ProductID'),
            new StringColumn('Name', 140),
            new StringColumn('SeoSafeName', 140),
            new MySqlMediumTextColumn('Description'),
            new CommaSeparatedListColumn('Keywords'),
            new ForeignKeyColumn('CategoryID'),
            new IntegerColumn('AmountAvailable'),
            new JsonColumn('Properties'),
            new CommaSeparatedListColumn('ShippingTypes'),
            new BooleanColumn('Live')
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

    public function setName($name)
    {
        $this->modelData['Name'] = $name;

        $clean_name = strtr($name, [
            '�' => 'S',
            '�' => 'Z',
            '�' => 's',
            '�' => 'z',
            '�' => 'Y',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'C',
            '�' => 'E',
            '�' => 'E',
            '�' => 'E',
            '�' => 'E',
            '�' => 'I',
            '�' => 'I',
            '�' => 'I',
            '�' => 'I',
            '�' => 'N',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'U',
            '�' => 'U',
            '�' => 'U',
            '�' => 'U',
            '�' => 'Y',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'c',
            '�' => 'e',
            '�' => 'e',
            '�' => 'e',
            '�' => 'e',
            '�' => 'i',
            '�' => 'i',
            '�' => 'i',
            '�' => 'i',
            '�' => 'n',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'u',
            '�' => 'u',
            '�' => 'u',
            '�' => 'u',
            '�' => 'y',
            '�' => 'y'
        ]);
        $clean_name = strtr($clean_name, ['�' => 'TH', '�' => 'th', '�' => 'DH', '�' => 'dh', '�' => 'ss', '�' => 'OE', '�' => 'oe', '�' => 'AE', '�' => 'ae', '�' => 'u']);
        $clean_name = preg_replace(['/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'], ['-', '-', '-'], $clean_name);
        $clean_name = preg_replace('/\-+/', '-', $clean_name);
        $this->SeoSafeName = $clean_name;
    }
}
