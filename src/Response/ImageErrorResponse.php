<?php

namespace SuperCMS\Response;

use Rhubarb\Crown\Response\Response;

class ImageErrorResponse extends Response
{
    public function __construct($message, $generator = null)
    {
        parent::__construct($generator);

        $this->setResponseCode(Response::HTTP_STATUS_CLIENT_ERROR_BAD_REQUEST);
        $this->setResponseMessage("400 Unauthorized");

        $this->setContent($message);
    }
}
