<?php

namespace SuperCMS\Controls\HtmlEditor;

use Rhubarb\Leaf\Controls\Common\Text\TextArea;

class HtmlEditor extends TextArea
{
    protected function getViewClass()
    {
        return HtmlEditorView::class;
    }
}
