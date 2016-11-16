<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Leaf\Controls\Common\FileUpload\UploadedFileDetails;
use Rhubarb\Stem\Filters\AndGroup;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\Filter;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\BooleanColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;


/**
 *
 *
 * @property int $CategoryID Repository field
 * @property int $ParentCategoryID Repository field
 * @property string $Name Repository field
 * @property string $SeoSafeName Repository field
 * @property string $Image Repository field
 * @property bool $Visible Repository field
 * @property-read Product[]|\Rhubarb\Stem\Collections\RepositoryCollection $Products Relationship
 * @property-read Category[]|\Rhubarb\Stem\Collections\RepositoryCollection $ChildCategories Relationship
 * @property-read Category $ParentCategory Relationship
 * @property-read mixed $PublicUrl {@link getPublicUrl()}
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
            new StringColumn('SeoSafeName', 100),
            new StringColumn('Image', 300),
            new BooleanColumn('Visible', false)
        );

        $model->labelColumnName = 'Name';

        return $model;
    }

    public function uploadImage(UploadedFileDetails $uploadData, $save = true)
    {
        if ($uploadData) {
            $uploadPath = __DIR__ . '/../../../static/images/category/' . $this->CategoryID . '/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 777, true);
            }

            $finalLocation = $uploadPath . sha1($this->UniqueIdentifier) . '-' . $uploadData->originalFilename;
            rename($uploadData->tempFilename, $finalLocation);

            $this->Image = str_replace(APPLICATION_ROOT_DIR, '',realpath($finalLocation));
            if ($save) {
                $this->save();
            }
        }
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

    public static function find(Filter ...$filters)
    {
        return parent::find(new AndGroup([new Equals('Visible', true), new AndGroup($filters)]));
    }

    public function getPublicUrl()
    {
        return '/category/' . $this->SeoSafeName . '/';
    }
}
