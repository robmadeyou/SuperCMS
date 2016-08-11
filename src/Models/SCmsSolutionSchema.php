<?php

namespace SuperCMS\Models;

use Rhubarb\Stem\Schema\SolutionSchema;
use SuperCMS\Models\Product\Product;

class SCmsSolutionSchema extends SolutionSchema
{
    public function __construct()
    {
        parent::__construct();

        
        $this->addModel('Product', Product::class);
    }
}
