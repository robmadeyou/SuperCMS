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
 * @property int $CategoryID Repository field
 * @property int $ParentCategoryID Repository field
 * @property string $Name Repository field
 * @property-read Product[]|\Rhubarb\Stem\Collections\Collection $Products Relationship
 * @property-read Category[]|\Rhubarb\Stem\Collections\Collection $ChildCategories Relationship
 * @property-read Category $ParentCategory Relationship
 */
class Category extends Model
{
    protected function createSchema()
    {
        $model = new MySqlModelSchema('tblCategory');

        $model->addColumn(
            new AutoIncrementColumn('CategoryID'),
            new ForeignKeyColumn('ParentCategoryID'),
            new StringColumn('Name', 50),
            new StringColumn('SeoSafeName', 100)
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
            'Á' => 'A',
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
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
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
            'Ý' => 'Y',
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
        $clean_name = strtr($clean_name, ['Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u']);
        $clean_name = preg_replace(['/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'], ['-', '-', '-'], $clean_name);
        $clean_name = preg_replace('/\-+/', '-', $clean_name);
        $this->SeoSafeName = $clean_name;
    }
}
