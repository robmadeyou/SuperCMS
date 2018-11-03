<?php

namespace SuperCMS\Leaves\Files\Upload;

use Rhubarb\Leaf\Leaves\LeafModel;
use SuperCMS\Models\Image\Image;

class ImageUploadModel extends LeafModel
{
    /** @var Image|null $uploadedImage */
    public $uploadedImage = null;
    public $suppressStateInputNameAttribute = true;
    public $suppressContainingForm = true;

    public function __construct()
    {
        parent::__construct();
    }
}
