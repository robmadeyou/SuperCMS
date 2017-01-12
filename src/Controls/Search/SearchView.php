<?php

namespace SuperCMS\Controls\Search;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;
use SuperCMS\Controls\HtmlButton\HtmlButton;
use SuperCMS\Session\SuperCMSSession;

class SearchView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $input = new TextBox('Query'),
            $submit = new HtmlButton('Search', 'Search  <i class="fa fa-search" aria-hidden="true"></i>', function() {
                $session = SuperCMSSession::singleton();
                $session->searchQuery = $this->model->Query;
                $session->storeSession();
                throw new ForceResponseException(new RedirectResponse('/search/'));
            })
        );

        $input->addHtmlAttribute('autocomplete', 'off');

        $input->setPlaceholderText('Search for products');
        $submit->addCssClassNames('button search-button');
    }

    protected function printViewContent()
    {
        ?>

        <div class="row search-group">
            <div class="col-sm-10 search-input">
                <i class="fa fa-search" aria-hidden="true"></i>
                <?= $this->leaves['Query']; ?>
                <ul class="search-response"></ul>
            </div>
            <div class="col-sm-2">
                <?= $this->leaves['Search']; ?>
            </div>
        </div>

        <?php
    }

    public function getDeploymentPackage()
    {
        $package = new LeafDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';
        return $package;
    }

    protected function getViewBridgeName()
    {
        return 'SearchViewBridge';
    }
}
