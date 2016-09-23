<?php

namespace SuperCMS\Views;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Paging\Leaves\EventPagerView;

class SuperCMSEventPagerView extends EventPagerView
{
    /**
     * @var int  The number of pages around the boundaries to show before hiding page links in favour of an ellipsis
     */
    public $bufferPages = 3;

    /**
     * CSS Classes for pager HTML elements
     */
    public $firstPageCssClass = 'first';
    public $selectedPageCssClass = 'selected';
    public $pageCssClass = 'pager-item';
    public $pagerBufferCssClass = 'pager-buffer';
    public $containerCssClass = '';
    public $innerContainerCssClass = 'pagination';

    public function printViewContent()
    {
        // Don't show any pages if there only is one page.
        if ($this->model->numberOfPages <= 1) {
            return;
        }

        $pages = [];
        $stub = $this->model->leafPath;

        /**
         * @var WebRequest $request
         */
        $request = Request::current();

        $iteration = 0;
        $classes = [$this->firstPageCssClass];
        while ($iteration < $this->model->numberOfPages) {
            $pageNumber = $iteration + 1;

            if ($pageNumber > $this->bufferPages && $pageNumber < $this->model->pageNumber - $this->bufferPages) {
                // If we're past the first few pages but are still a few pages before our selected page
                // and there is more than 1 page number to hide, show an ellipsis instead and skip forward
                $pages[] = '<li class="disabled ' . $this->pagerBufferCssClass . '"><span>&hellip;</span></li>';
                $iteration = $this->model->pageNumber - $this->bufferPages;
                continue;
            }
            if ($pageNumber < $this->model->numberOfPages - $this->bufferPages && $pageNumber > $this->model->pageNumber + $this->bufferPages - 1) {
                // If we're earlier than the last few pages but are a few pages after our selected page
                // and there is more than 1 page number to hide, show an ellipsis instead and skip forward
                $pages[] = '<li class="disabled ' . $this->pagerBufferCssClass . '"><span>&hellip;</span></li>';
                $iteration = $this->model->numberOfPages - $this->bufferPages;
                continue;
            }

            if ($pageNumber == $this->model->pageNumber) {
                $classes[] = $this->selectedPageCssClass;
            }

            $classes[] = $this->pageCssClass;

            $classAttr = ' class="' . implode(' ', $classes) . '"';

            $pages[] = '<li><a href="' . $request->urlPath . '?' . $stub . '-page=' . $pageNumber . '"' . $classAttr . ' data-page="' . $pageNumber . '">' . $pageNumber . '</a></li>';

            $classes = [];

            $iteration++;
        }

        print '<nav aria-label="Page navigation" class="' . $this->containerCssClass . '"><ul class="' . $this->innerContainerCssClass . '">' . implode('', $pages) . '</ul></nav>';
    }
}
