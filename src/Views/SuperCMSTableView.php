<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Table\Leaves\Columns\SortableColumn;
use Rhubarb\Leaf\Table\Leaves\Columns\Template;
use Rhubarb\Leaf\Table\Leaves\TableView;
use Rhubarb\Stem\Decorators\DataDecorator;

class SuperCMSTableView extends TableView
{
    public function printViewContent()
    {
        $tableClasses = $this->model->getClassAttribute();
        $this->model->cssClassNames = [];
        $suppressPagerContent = false;

        if ($this->model->unsearchedHtml && !$this->model->searched) {
            print $this->model->unsearchedHtml;
            $suppressPagerContent = true;
        } elseif (count($this->model->collection) == 0 && $this->model->noDataHtml) {
            print $this->model->noDataHtml;
            $suppressPagerContent = true;
        }

        //Always print the pager so we get javaScript loading
        //$this->leaves["pager"]->setSuppressContent($suppressPagerContent);
        $this->leaves["EventPager"]->setNumberPerPage($this->model->pageSize);
        $this->leaves["EventPager"]->setCollection($this->model->collection);
        print $this->leaves["EventPager"];

        if ($suppressPagerContent) {
            return;
        }

        ?>
        <div class='list table-responsive'>
            <table<?= $tableClasses; ?>>
                <thead>
                <tr>
                    <?php

                    $sorts = $this->model->collection->getSorts();

                    foreach ($this->model->columns as $column) {
                        $classes = $column->getCssClasses();

                        if ($column instanceof SortableColumn) {
                            $classes[] = "sortable";

                            if (isset($sorts[$column->getSortableColumnName()])) {
                                $classes[] = "sorted";

                                if ($sorts[$column->getSortableColumnName()] == false) {
                                    $classes[] = "descending";
                                }
                            }
                        }

                        $classString = implode(" ", $classes);

                        if ($classString != "") {
                            $classString = " class=\"" . $classString . "\"";
                        }

                        print "\r\n\t\t\t\t\t<th" . $classString . ">" . $column->label . "</th>";
                    }

                    ?>
                </tr>
                </thead>
                <tbody>
                <?php

                $rowNumber = 0;
                foreach ($this->model->collection as $model) {

                    $classes = $this->model->getRowCssClassesEvent->raise($model, $rowNumber);

                    $classString = "";
                    if (!empty($classes) && is_array($classes)) {
                        $classString = implode(" ", $classes);

                        if ($classString != "") {
                            $classString = " class=\"" . $classString . "\"";
                        }
                    }

                    $rowData = $this->model->getAdditionalClientSideRowDataEvent->raise($model, $rowNumber);

                    $rowDataString = "";
                    if (is_array($rowData) && count($rowData)) {
                        $rowDataString .= " data-row-data=\"" . htmlentities(json_encode($rowData)) . "\"";
                    }

                    print "\r\n\t\t\t\t<tr data-row-id=\"" . $model->UniqueIdentifier . "\"$classString$rowDataString>";

                    $decorator = DataDecorator::getDecoratorForModel($model);

                    if (!$decorator) {
                        $decorator = $model;
                    }

                    foreach ($this->model->columns as $column) {
                        $cellContent = $column->getCellContent($model, $decorator);

                        $classes = $column->getCssClasses();


                        if (!($column instanceof Template && (preg_match("/<a/", $cellContent)))) {
                            $classes[] = "clickable";
                        }

                        $classString = implode(" ", $classes);

                        if ($classString != "") {
                            $classString = " class=\"" . $classString . "\"";
                        }

                        $customAttributes = $column->getCustomCellAttributes($model);
                        $customAttributesString = "";

                        if (sizeof($customAttributes) > 0) {
                            foreach ($customAttributes as $name => $value) {
                                $customAttributesString .= " " . $name . "=\"" . htmlentities($value) . "\"";
                            }
                        }

                        print "\r\n\t\t\t\t\t<td" . $classString . $customAttributesString . ">" . $cellContent . "</td>";
                    }

                    print "\r\n\t\t\t\t</tr>";

                    $rowNumber++;
                }

                ?>
                </tbody>
                <?php

                if (sizeof($this->model->footerProviders) > 0) {
                    print "<tfoot>";

                    foreach ($this->model->footerProviders as $provider) {
                        $provider->printFooter();
                    }

                    print "</tfoot>";
                }

                ?>
            </table>
        </div>
        <?php

        if ($this->model->repeatPagerAtBottom) {
            $this->leaves["EventPager"]->printWithIndex("bottom");
        }
    }

    protected function getViewBridgeName()
    {
        return "SuperCMSTableViewBridge";
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/SuperCMSTableViewBridge.js';
        return $package;
    }
}
