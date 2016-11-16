<?php

namespace SuperCMS\Leaves\Admin\Coupons;

use SuperCMS\Leaves\Admin\AdminCrudLeaf;

class CouponsItem extends AdminCrudLeaf
{
    protected function getViewClass()
    {
        return CouponsItemView::class;
    }

    protected function createModel()
    {
        $model = new CouponsItemModel();
        return $model;
    }

    protected function saveRestModel()
    {
        $dates = explode(' - ', $this->model->DateRange);
        if (isset($dates[0]) && $dates[0]) {
            $this->model->restModel->ValidFrom =  date_create_from_format('d/m/Y', $dates[0]);
        }

        if (isset($dates[1]) && $dates[1]) {
            $this->model->restModel->ValidTo = date_create_from_format('d/m/Y', $dates[1]);
        }

        $model = parent::saveRestModel();

        return $model;
    }
}
