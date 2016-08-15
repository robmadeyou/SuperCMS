<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;

class ProductsAdd extends ProductsEdit
{
    protected function createModel()
    {
        $model = new ProductsAddModel();
        return $model;
    }

    protected function getViewClass()
    {
        return ProductsAddView::class;
    }

    protected function redirectAfterCancel()
    {
        throw new ForceResponseException(new RedirectResponse("../"));
    }
}
