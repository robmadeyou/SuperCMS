<?php

namespace SuperCMS\Models\Notification;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Collections\Collection;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\BooleanColumn;
use Rhubarb\Stem\Schema\Columns\DateTimeColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 *
 *
 * @property int $NotificationID Repository field
 * @property string $Note Repository field
 * @property bool $Seen Repository field
 * @property string $Category Repository field
 * @property RhubarbDateTime $DateCreated Repository field
 * @property int $LinkID Repository field
 * @property-read mixed $NotificationIcon {@link getNotificationIcon()}
 * @property-read mixed $Link {@link getLink()}
 * @property-read mixed $TimeAgo {@link getTimeAgo()}
 */
class Notification extends Model
{
    const VERSION = 1;

    const CATEGORY_ORDER = 'Order';
    const CATEGORY_NOTE = 'Note';
    const CATEGORY_COMMENT = 'Comment';

    const CATEGORY_LIST = [
        self::CATEGORY_ORDER,
        self::CATEGORY_NOTE,
        self::CATEGORY_COMMENT,
    ];

    protected function createSchema()
    {
        $schema = new ModelSchema('tblNotification');

        $schema->addColumn(
            new AutoIncrementColumn('NotificationID'),
            new MySqlMediumTextColumn('Note'),
            new BooleanColumn('Seen'),
            new ForeignKeyColumn('LinkID'),
            new MySqlEnumColumn('Category', self::CATEGORY_NOTE, self::CATEGORY_LIST),
            new DateTimeColumn('DateCreated')
        );

        return $schema;
    }

    /**
     * @return Notification[]|Collection
     */
    public static function getUnreadNotifications()
    {
        return self::find(new Equals('Seen', false));
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord()) {
            $this->DateCreated = new RhubarbDateTime('now');
        }
    }

    public function getNotificationIcon()
    {
        switch ($this->Category) {
            case self::CATEGORY_ORDER:
                return '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
            case self::CATEGORY_COMMENT:
                return '<i class="fa fa-comment fa-fw" aria-hidden="true"></i>';
            case self::CATEGORY_NOTE:
                return '<i class="fa fa-envelope fa-fw" aria-hidden="true"></i>';
            default:
                return '';
        }
    }

    public function getLink()
    {
        switch ($this->Category) {
            case self::CATEGORY_ORDER:
                return '/admin/orders/' . $this->LinkID . '/';
            case self::CATEGORY_COMMENT:
            case self::CATEGORY_NOTE:
            default:
                return '';
        }
    }

    public function getTimeAgo()
    {
        $times = [
            "year" => 29030400,
            "month" => 2419200,
            "week" => 604800,
            "day" => 86400,
            "hour" => 3600,
            "minute" => 60,
        ];

        $timeDifference = time() - (new RhubarbDateTime($this->DateCreated))->format('U');
        foreach ($times as $name => $value) {
            if ($timeDifference >= $value) {
                $numberOfUnits = floor($timeDifference / $value);
                return $numberOfUnits . ' ' . $name . ($numberOfUnits != 1 ? 's' : '') .' ago';
            }
        }
        return 'just now';
    }
}
