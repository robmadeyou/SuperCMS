<?php

namespace SuperCMS\Controls\KeyValue;

use Rhubarb\Leaf\Leaves\Controls\Control;

class KeyValue extends Control
{
    /**
     * @var KeyValueModel
     */
    protected $model;

    protected function getViewClass()
    {
        return KeyValueView::class;
    }

    protected function createModel()
    {
        $model = new KeyValueModel();

        return $model;
    }

    public function setAddButtonClasses(array $classes)
    {
        $this->model->addClasses = $classes;
    }

    public function setRemoveButtonClasses(array $classes )
    {
        $this->model->removeClasses = $classes;
    }

    public function setInputClasses(array $text)
    {
        $this->model->inputClasses = $text;
    }

    public function setAddButtonText(string $text)
    {
        $this->model->addText = $text;
    }

    public function setRemoveButtonText(string $text)
    {
        $this->model->removeText = $text;
    }
}
