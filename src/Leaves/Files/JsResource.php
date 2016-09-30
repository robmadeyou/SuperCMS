<?php

namespace SuperCMS\Leaves\Files;

class JsResource extends FilesResponse
{
    public function getFileLocation()
    {
        return __DIR__ . '/../../../static/js/' . $this->getRequestedPath('/files/js/');
    }

    public function getFileType()
    {
        return 'text/plain';
    }
}
