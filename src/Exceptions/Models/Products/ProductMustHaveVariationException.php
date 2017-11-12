<?php

namespace SuperCMS\Exceptions\Models\Products;

use SuperCMS\Exceptions\Models\SuperCMSModelException;

class ProductMustHaveVariationException extends SuperCMSModelException
{
    public function __construct($privateMessage = "", \Exception $previous = null)
    {
        parent::__construct($privateMessage, null);
    }

    public function getPublicMessage()
    {
        return 'A Product must have at least one variation.';
    }
}
