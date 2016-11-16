<?php

namespace SuperCMS\Leaves\Files;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Response\GeneratesResponseInterface;

abstract class FilesResponse implements GeneratesResponseInterface
{
    public function generateResponse($request = null)
    {
        header('Content-type: ' . $this->getFileType());
        header('Content-Disposition: inline; filename="' . $this->getFilename() . '"');

        $file = $this->getFileLocation();
        if(file_exists($file)) {
            fpassthru(fopen($this->getFileLocation(), 'r'));
        }
        exit;
    }

    public function getRequestedPath($replace = '')
    {
        $request = Request::current();

        if($request->get('p')) {
            $safeish = $request->get('p');
        } else {
            $safeish = str_replace($replace, '', $request->urlPath);
        }

        $safeish = str_replace('../', '', $safeish);
        return $safeish;
    }

    public function getFilename()
    {
        return 'file';
    }

    public function getFileType()
    {
        return 'application/*';
    }

    abstract public function getFileLocation();
}
