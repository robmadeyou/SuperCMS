<?php

namespace SuperCMS\Leaves\Files;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use SuperCMS\Models\Image\Image;

class ImageResponse extends FilesResponse
{
    public function generateResponseForRequest($request = null)
    {
        $path = $this->getRequestedPath();

        $parts = array_values(array_filter(explode('/', $path)));

        if (($numOfParts = sizeof($parts)) >= 2) {
            try {
                $image = Image::fromUniqueName($parts[1]);

                $file = $this->getFileLocation($image, $parts);

                header('Content-type: ' . mime_content_type($file));
                header('Content-Disposition: inline; filename="' . $this->getFilename($image) . '"');

                if (file_exists($file)) {
                    fpassthru(fopen($file, 'r'));
                }
            } catch (RecordNotFoundException $ex) {
                return false;
            }
        }

        exit;
    }

    /**
     * @param Image|null $image
     * @param array $parts
     * @return bool|mixed|string
     * @throws RecordNotFoundException
     */
    public function getFileLocation($image = null, $parts = [])
    {
        $numOfParts = sizeof($parts);

        $image = Image::fromUniqueName($parts[1]);

        if ($numOfParts >= 4) {
            if (is_numeric($parts[2]) && is_numeric($parts[3])) {
                return $image->getResizedImagePath($parts[2], $parts[3]);
            }
        } else {
            return $image->Src;
        }

        return false;
    }

    public function getRequestedPath($replace = '')
    {
        $request = Request::current();

        if ($request instanceof WebRequest) {
            return $request->uri;
        }

        return '';
    }

    public function getFileType()
    {
        return 'image/*';
    }

    /**
     * @param Image|null $image
     * @return mixed|string
     */
    public function getFilename($image = null)
    {
        return $image->OriginalName;
    }
}