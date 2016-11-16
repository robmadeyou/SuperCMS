<?php

namespace SuperCMS\Controls\KeyValue;

use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class KeyValueView extends ControlView
{
    protected $requiresContainerDiv = true;

    /**
     * @var KeyValueModel
     */
    protected $model;

    protected function parseRequest(WebRequest $request)
    {
        $keys = $request->post($this->model->leafPath . "_key");
        $values = $request->post($this->model->leafPath . "_value");

        $data = [];

        if ($keys) {
            foreach ($keys as $key => $value) {
                $data[] = [$value, $values[$key]];
            }
            $this->setControlValueForIndex(null, $data);
        }
    }

    protected function printViewContent()
    {
        ?>
        <xmp id="hidden-line-placeholders" style="display: none;"><?php $this->printLine('', '') ?></xmp>
        <div class="key-value-group">
            <?php
            if ($this->model->value) {
                foreach ($this->model->value as $value) {
                    $this->printLine($value[0], $value[1]);
                }
            }
            ?>
        </div>
        <?php
        $this->printAddButton();
    }

    public function printAddButton()
    {
        print '<a href="#" class="' . implode(' ',
                $this->model->addClasses) . '" id="addTrigger">' . $this->model->addText . '</a>';
    }

    public function printRemoveButton()
    {
        print '<a href="#" class="' . implode(' ',
                $this->model->removeClasses) . '" id="removeTrigger">' . $this->model->removeText . '</a>';
    }

    public function printLine($key, $value)
    {
        $inputClass = implode(' ', $this->model->inputClasses);
        print '<div class="keyValueControl">
                <input class="' . $inputClass . '" id="' . $this->model->leafPath . '_key[' . $key . ']" name="' . $this->model->leafPath . '_key[' . $key . ']" type="text" value="' . htmlentities($key) . '">
                <input class="' . $inputClass . '" id="' . $this->model->leafPath . '_value[' . $key . ']" name="' . $this->model->leafPath . '_value[' . $key . ']" type="text" value="' . htmlentities($value) . '">';
        $this->printRemoveButton();
        print '<br></div>';
    }

    protected function getViewBridgeName()
    {
        return 'KeyValueViewBridge';
    }

    public function getDeploymentPackage()
    {
        $package = new LeafDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';

        return $package;
    }
}
