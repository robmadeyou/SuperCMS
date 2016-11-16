<?php

namespace SuperCMS\Leaves\Files;

class FontsResource extends FilesResponse
{
    public function getFileLocation()
    {
        return __DIR__ . '/../../../static/fonts/' . $this->getRequestedPath('/files/fonts/');
    }

    public function getFileType()
    {
        return 'text/plain';
    }
}
