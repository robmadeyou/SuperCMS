<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;

class ProductsAddView extends ProductsEditView
{
    protected function printViewContent()
    {
        $this->model->restModel->save();
        throw new ForceResponseException(new RedirectResponse('../' . $this->model->restModel->UniqueIdentifier . '/edit/'));
    }
}
