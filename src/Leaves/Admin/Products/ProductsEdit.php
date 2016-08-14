<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;

class ProductsEdit extends CrudLeaf
{
    protected function getViewClass()
    {
        return ProductsEditView::class;
    }

    protected function createModel()
    {
        $model = new ProductsEditModel();
        return $model;
    }

    protected function redirectAfterCancel()
    {
        throw new ForceResponseException(new RedirectResponse("../../"));
    }
}
