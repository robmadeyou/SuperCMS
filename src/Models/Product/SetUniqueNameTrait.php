<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Filters\Equals;

trait SetUniqueNameTrait
{
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

        $plus = "";
        $name = $clean_name . $plus;
        while (self::find(new Equals('SeoSafeName', $name))->count() != 0) {
            $name = $clean_name . $plus++;
        }

        $this->SeoSafeName = $name;
    }
}
