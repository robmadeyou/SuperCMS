<?php

namespace SuperCMS\Controls\Dropzone;

use Rhubarb\Leaf\Controls\Common\FileUpload\UploadedFileDetails;

class DropzoneUploadedFileDetails extends UploadedFileDetails
{
    public $id;

    /**
     * DropzoneUploadedFileDetails constructor.
     *
     * @param $originalFilename
     * @param $tempFilename
     * @param $id
     */
    public function __construct($originalFilename, $tempFilename, $id = 0)
    {
        parent::__construct($originalFilename, $tempFilename);

        $this->id = $id;
    }
}