<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;
use SuperCMS\Models\Product\ProductVariation;

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

    protected function saveRestModel()
    {
        if (!$this->model->restModel->Visible) {
            $this->model->restModel->Visible = true;
        }

        $model = parent::saveRestModel();

        /**
         * @var ProductVariation $variation;
         */
        $variation = $this->model->restModel->getDefaultProductVariation();
        $variation->Price = $this->model->Price;
        $variation->AmountAvailable = $this->model->restModel->AmountAvailable;
        $variation->Description = $this->model->restModel->Description;
        $variation->Properties = $this->model->restModel->Properties;
        $variation->Name = $this->model->restModel->Name;
        $variation->save();

        return $model;
    }
}
