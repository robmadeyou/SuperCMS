<?php

namespace SuperCMS\Layouts;

use Rhubarb\Crown\LoginProviders\UrlHandlers\ValidateLoginUrlHandler;
use Rhubarb\Crown\String\StringTools;
use Rhubarb\Leaf\LayoutProviders\LayoutProvider;

class AdminLayoutProvider extends LayoutProvider
{
    public function printItemsWithContainer($containerTitle, ...$items)
    {
        ?>
        <div class="panel panel-primary">
            <?php $this->printContainerTitle($containerTitle) ?>
            <div class="panel-body">
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
            </div>
        </div>
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
        } else {
            $control = $value;
        }

        if ($helpText) {
            print "<span class='help'>{$helpText}</span>";
        }

        print $this->parseStringAsTemplate($control);
    }
}
