<?php

namespace SuperCMS\Views;

use SuperCMS\Controls\Search\SearchLeaf;

trait SearchPanelTrait
{
    protected function createSearchPanel()
    {
        $this->registerSubLeaf(
            new SearchLeaf('Search')
        );
    }

    protected function printSearchPanel()
    {
        ?>
        <div class="search-controls">
            <?= $this->leaves['Search'] ?>
        </div>
        <?php
    }
}
