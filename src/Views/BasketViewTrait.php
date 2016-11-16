<?php

namespace SuperCMS\Views;

use SuperCMS\Controls\GlobalBasket\GlobalBasket;

class BasketViewTrait
{
    protected $basketObject;

    public function addBasketInput()
    {
        $this->registerSubLeaf(
            $this->basketObject = new GlobalBasket('Basket')
        );
    }
}
