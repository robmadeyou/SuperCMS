<?php

namespace SuperCMS\Controls\LocationPicker;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Controls\ControlModel;
use SuperCMS\Models\User\SuperCMSUser;

class LocationPickerModel extends ControlModel
{
    /**
     * @var SuperCMSUser $user
     */
    public $user;

    public $selectedLocation;

    /** @var Event $saveEvent */
    public $saveEvent;

    /** @var Event $cancelEvent */
    public $cancelEvent;

    /** @var Event $loadDataEvent */
    public $loadDataEvent;

    /** @var Event $deleteEvent */
    public $deleteEvent;

    /** @var Event $selectLocationEvent */
    public $selectLocationEvent;

    public $Country = '';
    public $PostCode = '';

    public function __construct()
    {
        parent::__construct();

        $this->saveEvent = new Event();
        $this->cancelEvent = new Event();
        $this->loadDataEvent = new Event();
        $this->deleteEvent = new Event();
        $this->selectLocationEvent = new Event();
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();
        $properties[] = 'selectedLocation';
        return $properties;
    }
}
