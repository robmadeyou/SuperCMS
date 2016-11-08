<?php

namespace SuperCMS\Views;

trait BreadcrumbTrait
{
    abstract function getBreadcrumbItems():Array;

    public function printBreadcrumbs()
    {
        print '<ul class="c-breadcrumb">';
        foreach ($this->getBreadcrumbItems() as $item) {
            $this->printBreadcrumbItem($item);
        }
        print '</ul>';
    }

    protected function printBreadcrumbItem($name)
    {
        print '<li class="c-breadcrumb--item">{$name}</li>';
    }
}