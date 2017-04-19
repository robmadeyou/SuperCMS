<?php

namespace SuperCMS\Views;

trait BreadcrumbTrait
{
    abstract function getBreadcrumbItems():array;

    public function printBreadcrumbs()
    {
        print '<ul class="c-breadcrumb">';
        foreach ($this->getBreadcrumbItems() as $item => $link) {
            $this->printBreadcrumbItem($item, $link);
        }
        print '<div class="clearfix"></div></ul>';
    }

    protected function printBreadcrumbItem($name, $link = '')
    {
        $splitName = strlen($name) > 20 ? str_split($name, 20)[0] . '&hellip;' : $name;
        $list = '<li class="c-breadcrumb--item"><span>' . $splitName . '</span></li>';

        if ($link) {
            $list = '<a href="' . $link . '">' . $list . '</a>';
        }

        print $list;
    }
}