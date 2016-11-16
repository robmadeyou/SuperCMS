<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\SearchPanel\Leaves\SearchPanelView;

class SuperCMSSearchPanelView extends SearchPanelView
{
    use BootstrapViewTrait;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->bootstrapInputs();
    }
}
