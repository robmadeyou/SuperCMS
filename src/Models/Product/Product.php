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
 * @property string $SeoSafeName Repository field
 * @property-read mixed $DefaultImage {@link getDefaultImage()}
 * @property-read mixed $PublicUrl {@link getPublicUrl()}
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
            new CommaSeparatedListColumn('RelatedProductIDs', 500, [], true),
            new StringColumn('SeoSafeName', 255)
        );

        $schema->labelColumnName = 'Name';

        return $schema;
    }

    public function getDefaultProductVariation()
    {
        if ($this->isNewRecord()) {
            $this->save();
        }

        $variations = $this->Variations;
        if ($variations->count() == 0) {
            $v = new ProductVariation();
            $v->ProductID = $this->UniqueIdentifier;
            $v->save();
            return $v;
        } else {
            return $variations[0];
        }
    }

    public function getDefaultImage()
    {
        $variation = $this->getDefaultProductVariation();
        if(isset($variation->Images[0])) {
            return $variation->getPrimaryImage();
        }
        return '/static/images/noimage.png';
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

    protected function afterSave()
    {
        parent::afterSave();

        if (!$this->Variations->count() && !isset($this->Importing)) {
            $this->getDefaultProductVariation();
        }
    }

    public function getPublicUrl()
    {
        return $this->Category->getPublicUrl() . 'product/' . $this->SeoSafeName . '/';
    }

    public static function find(Filter ...$filters)
    {
        return parent::find(new AndGroup([new Equals('Visible', true), new AndGroup($filters)]));
    }
}
