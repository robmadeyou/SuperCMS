<?php

namespace SuperCMS\Models\Image;

use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlIndex;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\JsonColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 * @property int $ImageID Repository field
 * @property string $UniqueName Repository field
 * @property string $Src Repository field
 * @property \stdClass $Sizes Repository field
 * @property-read mixed $OriginalUrl {@link getOriginalUrl()}
 */
class Image extends Model
{
    const VERSION = 2;

    protected function createSchema()
    {
        $schema = new ModelSchema('tblImage');

        $schema->addColumn(
            new AutoIncrementColumn('ImageID'),
            new StringColumn('OriginalName', 500),
            new StringColumn('UniqueName', 300),
            new StringColumn('Src', 300),
            new JsonColumn('Sizes')
        );

        $schema->addIndex(new MySqlIndex('Unique', MySqlIndex::UNIQUE, ['UniqueName']));

        return $schema;
    }

    private $vowels = ['a', 'e', 'i', 'o', 'u'];
    private $consonants = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'];

    private function getUniqueNameString()
    {
        $parts = [];
        for ($i = 0, $iEnd = rand(4, 10); $i < $iEnd; $i++) {
            $currentPart = '';

            $lastWasVowel = !rand(0, 1);

            for ($j = 0, $jEnd = rand(5, 12); $j < $jEnd; $j++) {
                if ($lastWasVowel) {
                    $currentPart .= $this->consonants[rand(0, sizeof($this->consonants) - 1)];
                } else {
                    $currentPart .= $this->vowels[rand(0, sizeof($this->vowels) - 1)];
                }

                $lastWasVowel = !$lastWasVowel;
            }

            $parts[] = $currentPart;
        }

        $uniqueName = implode('_', $parts);

        if (self::find(new Equals('UniqueName', $uniqueName))->count()) {
            return $this->getUniqueNameString();
        } else {
            return $uniqueName;
        }
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord()) {
            $this->UniqueName = $this->getUniqueNameString();
        }
    }

    public function getResizedImagePath($width, $height) {
        //TODO
    }

    public function getImageUrl($width = null, $height = null)
    {
        if ($width && $height) {
            return "/image/$this->UniqueName/$width/$height" ;
        }

        return '/image/' . $this->UniqueName;
    }

    /**
     * @param $name
     * @return Model|Image
     * @throws \Rhubarb\Stem\Exceptions\RecordNotFoundException
     */
    public static function fromUniqueName($name)
    {
        return self::findFirst(new Equals('UniqueName', $name));
    }

    public static function createImageFromFileDate($data)
    {
        $image = new self();
        $image->OriginalName = $data['name'];
        $image->save();

        //TODO make this nice and optimizationalytional
        if (!is_dir($dir = APPLICATION_ROOT_DIR . '/static/images/' . $image->UniqueIdentifier . '/')) {
            mkdir($dir, 0777, true);
        }

        $target = $dir . 'o';
        rename($data['tmp_name'], $target);

        $image->Src = $target;
        $image->save();

        return $image;
    }
}
