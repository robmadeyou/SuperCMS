<?php

namespace SuperCMS\Leaves\Admin\Products\ProductVariations;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Controls\Notification\NotificationPrint;
use SuperCMS\Exceptions\Models\Products\ProductMustHaveVariationException;
use SuperCMS\Exceptions\Models\SuperCMSModelException;
use SuperCMS\Models\Product\Product;

class ProductVariations extends Leaf
{
    /**
     * @var ProductVariationsModel $model
     */
    protected $model;
    protected $product = null;

    public function __construct(Product $product, $name = null, $initialiseModelBeforeView = null)
    {
        $this->product = $product;

        parent::__construct($name, $initialiseModelBeforeView);
    }

    protected function createModel()
    {
        return new ProductVariationsModel();
    }

    protected function getViewClass()
    {
        return ProductVariationsView::class;
    }

    protected function onModelCreated()
    {
        $this->model->product = $this->product;

        if (!$this->model->selectedVariationId) {
            $this->model->selectedVariationId = $this->model->getVariations()[ 0 ]->UniqueIdentifier;
        }

        $this->model->saveVariationEvent->attachHandler(function() {
            $variation = $this->model->getCurrentVariation();

            $variation->Name = $this->model->Name;
            $variation->Price = $this->model->Price;
            $variation->AmountAvailable = $this->model->AmountAvailable;
            $variation->Description = $this->model->Description;

            $variation->save();
        });

        $this->model->changeVariationEvent->attachHandler(function ($oldId, $newId) {
            $this->model->saveVariationEvent->raise();

            $this->model->selectedVariationId = $newId;

            $newVariation = $this->model->getCurrentVariation();

            $data = new \stdClass();
            $data->Name = $newVariation->Name;
            $data->Price = $newVariation->Price;
            $data->AmountAvailable = $newVariation->AmountAvailable;
            $data->Description = $newVariation->Description;
            return $data;
        });

        $this->model->deleteVariationEvent->attachHandler(function ($id) {
            $response = new \stdClass();
            $response->success = false;

            $variations = $this->model->getVariations()->filter(new Equals('ProductVariationID', $id));

            if ($variations->count()) {
                try {
                    $variations[0]->delete();
                    $response->success = true;
                } catch (SuperCMSModelException $ex) {
                    print new NotificationPrint('Unable to delete Variation: ' . $ex->getPublicMessage(), NotificationPrint::DANGER);
                }
            }

            return $response;
        });
    }
}
