<?php

namespace SuperCMS\Controls\LocationPicker;

use Rhubarb\Crown\LoginProviders\Exceptions\NotLoggedInException;
use Rhubarb\Leaf\Leaves\Controls\Control;
use Rhubarb\Scaffolds\Authentication\User;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Controls\GlobalBasket\GlobalBasket;
use SuperCMS\LoginProviders\SCmsLoginProvider;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Models\User\Location;
use SuperCMS\Models\User\SuperCMSUser;
use SuperCMS\Session\SuperCMSSession;

class LocationPicker extends Control
{
    /** @var LocationPickerModel */
    protected $model;

    protected function getViewClass()
    {
        return LocationPickerView::class;
    }

    protected function createModel()
    {
        return new LocationPickerModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        try {
            $this->setUser( SCmsLoginProvider::getLoggedInUser() );
        } catch ( NotLoggedInException $ex ) {
        }

        $this->model->saveEvent->attachHandler( function () {
            $location = $this->loadLocationFromModel();

            if (!$location) {
                $location = new Location();
            }

            $location->Recipient = $this->model->Recipient;
            $location->AddressLine1 = $this->model->AddressLine1;
            $location->AddressLine2 = $this->model->AddressLine2;
            $location->Town = $this->model->Town;
            $location->PostCode = $this->model->PostCode;
            $location->Country = $this->model->Country;
            $location->PhoneNumber = $this->model->PhoneNumber;
            if ($this->model->user) {
                $location->UserID = $this->model->user->UniqueIdentifier;
            }
            $location->BasketID = Basket::getCurrentBasket()->UniqueIdentifier;
            $location->save();
        } );

        $this->model->loadDataEvent->attachHandler( function () {
            $location = $this->loadLocationFromModel();

            $data = new \stdClass();
            $data->Recipient = '';
            $data->AddressLine1 = '';
            $data->AddressLine2 = '';
            $data->Town = '';
            $data->PostCode = '';
            $data->Country = '';
            $data->PhoneNumber = '';

            if ($location) {
                $data = new \stdClass();
                $data->Recipient = $location->Recipient;
                $data->AddressLine1 = $location->AddressLine1;
                $data->AddressLine2 = $location->AddressLine2;
                $data->Town = $location->Town;
                $data->PostCode = $location->PostCode;
                $data->Country = $location->Country;
                $data->PhoneNumber = $location->PhoneNumber;
            }

            return $data;
        } );

        $this->model->deleteEvent->attachHandler( function () {
            $location = $this->loadLocationFromModel();

            if ($location) {
                $location->delete();
                $this->reRender();
            }
        } );

        $this->model->selectLocationEvent->attachHandler(function($selected) {
            $location = $this->loadLocationFromModel($selected);
            if ($location && $this->model->user) {
                $this->model->user->PrimaryLocationID = $selected;
                $this->model->user->save();
            }
        });
    }

    /**
     * @param int $locationId
     *
     * @return bool|Location
     */
    private function loadLocationFromModel($locationId = 0)
    {
        $locationId = $locationId ? : $this->model->selectedLocation;
        if ($locationId) {
            $locations = SuperCMSUser::getUserLocations()->filter(new Equals('LocationID', $locationId));
            if ($locations->count()) {
                return $locations[0];
            }
        }
        return false;
    }

    public function setUser(User $user)
    {
        $this->model->user = $user;
    }
}
