<?php

namespace SuperCMS\Controls\Search;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;

class SearchModel extends LeafModel
{
    public $searchText = '';

    /** @var Event */
    public $searchEvent;

    public function __construct()
    {
        parent::__construct();

        $this->searchEvent = new Event();
    }
}
