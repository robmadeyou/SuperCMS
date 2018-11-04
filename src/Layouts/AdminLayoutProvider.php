<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\String\StringTools;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\LayoutProviders\LayoutProvider;
use Rhubarb\Leaf\Leaves\Controls\Control;
use SuperCMS\Controls\Dropzone\Dropzone;
use SuperCMS\Controls\KeyValue\KeyValue;

class AdminLayoutProvider extends LayoutProvider
{
    public function printItemsWithContainer($containerTitle, ...$items)
    {
        ?>
        <?php $this->printContainerTitle($containerTitle) ?>
        <?php
        foreach ($items as $key => $item) {
            if (is_array($item)) {
                foreach ($item as $subKey => $subItem) {
                    $this->printValueWithLabel($subItem, $this->getNameForValue($subKey, $subItem));
                }
            } else {
                $this->printValueWithLabel($item, $this->getNameForValue($key, $items));
            }
        }
        ?>
        <?php
    }

    private function getNameForValue($label, $valueName)
    {
        if (!$label || is_numeric($label)) {
            return StringTools::wordifyStringByUpperCase($valueName);
        }

        return $label;
    }

    public function printContainerTitle($containerTitle)
    {
        print '<div class="panel-heading">' . $containerTitle . '</div>';
    }

    public function printLabelValuePairs($pairs)
    {
        foreach ($pairs as $name => $pair) {
            $this->printValueWithLabel($pair, $name);
        }
    }

    public function printValueWithLabel($value, $label)
    {
        $this->printLabel($label);
        $this->printValue($value);
    }

    public function printLabel($label)
    {
        print $label;
    }

    public function printValue($value)
    {
        $helpText = '';

        if (is_array($value)) {
            $helpText = $value[0];
            $value = $value[1];
        }

        if (is_string($value)) {
            $control = $this->generateValue($value);
            if ($control instanceof Control) {
                if ($control instanceof Dropzone) {
                } else if ($control instanceof KeyValue) {
                } else if ($control instanceof TextBox) {
                    $control->addCssClassNames('c-textbox');
                } else {
                }
            }
        } else {
            $control = $value;
        }

        if ($helpText) {
            print "<span class='help'>{$helpText}</span>";
        }

        print $this->parseStringAsTemplate($control);
    }
}
