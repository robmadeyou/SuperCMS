<?php

namespace SuperCMS\Models\Notification;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\BooleanColumn;
use Rhubarb\Stem\Schema\Columns\DateTimeColumn;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 *
 *
 * @property int $NotificationID Repository field
 * @property string $Note Repository field
 * @property bool $Seen Repository field
 * @property string $Category Repository field
 * @property RhubarbDateTime $DateCreated Repository field
 */
class Notification extends Model
{
    protected function createSchema()
    {
        $schema = new ModelSchema('tblNotification');

        $schema->addColumn(
            new AutoIncrementColumn('NotificationID'),
            new MySqlMediumTextColumn('Note'),
            new BooleanColumn('Seen'),
            new MySqlEnumColumn('Category', 'Order', ['Order']),
            new DateTimeColumn('DateCreated')
        );

        return $schema;
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord()) {
            $this->DateCreated = new RhubarbDateTime('now');
        }
    }

}
