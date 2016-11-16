<?php

namespace SuperCMS\Controls\Carousel;

use Rhubarb\Leaf\Leaves\Leaf;

class Carousel extends Leaf
{
    /**
     * @var CarouselModel $model
     */
    protected $model;

    protected function getViewClass()
    {
        return CarouselView::class;
    }

    protected function createModel()
    {
        $model = new CarouselModel();
        return $model;
    }

    public function setCarouselImages(array $images)
    {
        $this->model->sliderImages = $images;
    }
}
