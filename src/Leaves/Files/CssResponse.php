<?php

namespace SuperCMS\Leaves\Files;

class CssResponse extends FilesResponse
{
    public function getFileLocation()
    {
        return __DIR__ . '/../../../static/css/' . $this->getRequestedPath('/files/css/');
    }

    public function getFileType()
    {
        return 'text/css';
    }
}
