<?php

namespace SuperCMS\Controls\HtmlButton;

use Rhubarb\Leaf\Controls\Common\Buttons\ButtonView;

class HtmlButtonView extends ButtonView
{
    protected function printViewContent()
    {
        $classes = $this->model->getClassAttribute();
        $otherAttributes = $this->model->getHtmlAttributes();

        $confirmAttribute = ($this->model->confirmMessage != "") ? ' confirm="' . htmlentities($this->model->confirmMessage) . '"' : '';
        $xhrAttribute = ($this->model->useXhr) ? ' xmlrpc="yes"' : '';

        ?>
        <button leaf-name="<?= $this->model->leafName; ?>"
                type="<?= $this->model->type ?>"
                name="<?= $this->model->leafPath; ?>"
                id="<?= $this->model->leafPath; ?>"
                value="<?= htmlentities($this->model->text) ?>" <?= $classes . $otherAttributes . $confirmAttribute . $xhrAttribute; ?>><?= $this->model->text ?></button>
        <?php
    }
}
