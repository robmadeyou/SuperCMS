<?php

namespace SuperCMS\Controls\CustomTable;

use Rhubarb\Leaf\Table\Leaves\Table;
use Rhubarb\Stem\Collections\Collection;

class SCMSCustomTable extends Table
{
    private $className;

    public function __construct($className, Collection $list = null, int $pageSize = 50, string $presenterName = "Table")
    {
        $this->className = $className;

        parent::__construct($list, $pageSize, $presenterName);
    }

    protected function getViewClass()
    {
        return $this->className;
    }
}
