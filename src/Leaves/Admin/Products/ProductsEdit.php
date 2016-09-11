<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Models\Model;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductVariation;

class ProductsEdit extends CrudLeaf
{
    /**
     * @var ProductsEditModel $model
     */
    protected $model;

    protected function getViewClass()
    {
        return ProductsEditView::class;
    }

    protected function createModel()
    {
        $model = new ProductsEditModel();

        $model->ChangeProductVariationEvent->attachHandler(function($id) {
            try {
                $this->saveVariation(new ProductVariation($this->model->selectedVariation['ProductVariationID']));
                $this->setSelectedVariation(new ProductVariation($id));
                $this->reRender();
            } catch (RecordNotFoundException $ex) {}
        });

        $model->AddNewProductEvent->attachHandler(function() {
            try
            {
                $this->saveVariation(new ProductVariation($this->model->selectedVariation['ProductVariationID']));
            } catch (RecordNotFoundException $ex) {}
            $variation = new ProductVariation();
            $variation->ProductID = $this->model->restModel->ProductID;
            $variation->save();
            $this->setSelectedVariation($variation);
            $this->reRender();
        });

        return $model;
    }

    protected function redirectAfterCancel()
    {
        throw new ForceResponseException(new RedirectResponse("../../"));
    }

    /**
     * @param Product $restModel
     */
    public function setRestModel(Model $restModel)
    {
        if (!$this->model->selectedVariation) {
            $this->setSelectedVariation($restModel->getDefaultProductVariation());
        }

        parent::setRestModel($restModel);
    }

    public function setSelectedVariation(ProductVariation $variation) {
        $this->model->selectedVariation = $variation;
        $this->model->Name = $variation->Name;
        $this->model->Price = $variation->Price;
        $this->model->AmountAvailable = $variation->AmountAvailable;
        $this->model->VariationDescription = $variation->Description;
        $this->model->Properties = $variation->Properties;
    }

    protected function saveRestModel()
    {
        if (!$this->model->restModel->Visible) {
            $this->model->restModel->Visible = true;
        }

        $model = parent::saveRestModel();

        $this->saveVariation(new ProductVariation($this->model->selectedVariation['ProductVariationID']));

        return $model;
    }

    /**
     * @param ProductVariation $variation
     * @return ProductVariation
     * @throws \Exception
     * @throws \Rhubarb\Stem\Exceptions\ModelConsistencyValidationException
     */
    private function saveVariation(ProductVariation $variation)
    {
        $variation->Name = $this->model->Name;
        $variation->Price = $this->model->Price;
        $variation->AmountAvailable = $this->model->AmountAvailable;
        $variation->Description = $this->model->VariationDescription;
        $variation->Properties = $this->model->Properties;
        $variation->save();

        return $variation;
    }
}
