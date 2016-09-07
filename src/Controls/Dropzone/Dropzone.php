<?php

namespace SuperCMS\Controls\Dropzone;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Crown\Response\FileResponse;
use Rhubarb\Crown\Response\NotAuthorisedResponse;
use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;
use Rhubarb\Leaf\Controls\Common\FileUpload\UploadedFileDetails;
use SuperCMS\Response\ImageErrorResponse;

class Dropzone extends SimpleFileUpload
{
    protected function getViewClass()
    {
        return DropzoneView::class;
    }

    protected function parseRequest(WebRequest $request)
    {
        $fileData = $request->filesData;

        $response = null;

        if (!empty( $fileData ) && reset($fileData)) {
            $fileData = reset($fileData);
            if (is_array($fileData[ "name" ])) {
                foreach ($fileData[ "name" ] as $index => $name) {
                    if ($fileData[ "error" ][ $index ] == UPLOAD_ERR_OK) {
                        $realIndex = str_replace("_", "", $index);
                        $response = $this->fileUploadedEvent->raise(
                            new UploadedFileDetails($name, $fileData[ "tmp_name" ][ $index ]),
                            $realIndex
                        );
                    }
                }
            } else {
                if ($fileData[ "error" ] == UPLOAD_ERR_OK) {
                    $response = $this->fileUploadedEvent->raise(
                        new UploadedFileDetails($fileData[ "name" ], $fileData[ "tmp_name" ]),
                        $this->model->leafIndex
                    );
                }
            }
        }

        return $response;
    }

    protected function createModel()
    {
        $req = Request::current();

        $model = new DropzoneModel();

        if (isset( $req->urlPath )) {
            $model->postUrl = $req->urlPath;
        }

        return $model;
    }
}
