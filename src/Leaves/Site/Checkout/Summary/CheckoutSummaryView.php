<?php

namespace SuperCMS\Leaves\Site\Checkout\Summary;

use Rhubarb\Leaf\Table\Leaves\FooterProviders\FooterColumnsFooterProvider;
use Rhubarb\Leaf\Table\Leaves\FooterProviders\LabelFooterColumn;
use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Controls\HtmlButton\HtmlButton;
use SuperCMS\Leaves\Site\Checkout\CheckoutView;
use SuperCMS\SuperCMS;

class CheckoutSummaryView extends CheckoutView
{
    protected function getTitle()
    {
        return 'Summary';
    }

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $table = new Table($this->model->basket->BasketItems, '10', 'SummaryTable'),
            $nextButton = new HtmlButton('Next', 'Next: Address', function() {
                $this->model->nextEvent->raise();
            })
        );

        $nextButton->addCssClassNames('button', 'button-checkout');

        $table->addCssClassNames('table', 'table-striped', 'table-bordered', 'table-hover');

        $table->columns = [
            'Item' => '<a href="{ProductVariation.PublicUrl}">{ProductVariation.Name}</a>',
            'Quantity' => 'x {Quantity}',
            'Cost' => '{TotalCost}'
        ];

        $footer = new FooterColumnsFooterProvider();
        $footer->setColumns(
            [
                new LabelFooterColumn('Total:', 1),
                new LabelFooterColumn('x ' . $this->model->basket->getTotalQuantity(), 1),
                new LabelFooterColumn(SuperCMS::$currencySymbol . number_format($this->model->basket->getTotalCost(), 2), 1)
            ]
        );
        $table->addFooter($footer);
    }

    protected function printBody()
    {
        print $this->leaves['SummaryTable'];
    }

    protected function printStepButtons()
    {
        print '<a href="/" class="btn btn-default">Cancel</a>' . $this->leaves['Next'];
    }
}
