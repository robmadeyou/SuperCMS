<?php

namespace SuperCMS\Settings;

use Rhubarb\Scaffolds\ApplicationSettings\Settings\ApplicationSettings;

/**
 * Class SuperCMSSettings
 * @package SuperCMS\Settings
 *
 * @property boolean $developmentMode
 * @property string $stripeLiveToken
 * @property string $stripeTestToken
 * @property boolean $enableStripePayment
 */
class SuperCMSSettings extends ApplicationSettings
{
    public function getStripeToken()
    {
        if ($this->developmentMode) {
            return $this->stripeTestToken;
        }
        return $this->stripeLiveToken;
    }
}