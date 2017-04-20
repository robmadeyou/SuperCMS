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
            $submit = new HtmlButton('Search', '<span>Search</span>  <i class="fa fa-search" aria-hidden="true"></i>', function() {
                $session = SuperCMSSession::singleton();
                $session->searchQuery = $this->model->Query;
                $session->storeSession();
                throw new ForceResponseException(new RedirectResponse('/search/'));
            })
        );

        $input->addHtmlAttribute('autocomplete', 'off');

        $input->setPlaceholderText('Search for products');
        $submit->addCssClassNames('button', 'button-icon-mobile', 'button--stretch');
    }

    protected function printViewContent()
    {
        ?>

        <div class="row search-group">
            <div class="col-xs-10 search-input">
                <div class="search-input-group">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <?= $this->leaves['Query']; ?>
                </div>
                <div class="c-result-section">
                    <div class="c-suggested-items">
                    </div>
                    <div class="c-result-section-inner">
                        <ul class="search-response"></ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-2">
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
