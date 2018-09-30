<?php

namespace SuperCMS\Settings;

use Rhubarb\Scaffolds\ApplicationSettings\Settings\ApplicationSettings;

/**
 * Class SuperCMSSettings
 *
 * @package SuperCMS\Settings
 *
 * @property boolean $developmentMode
 * @property string  $stripeLiveSecret
 * @property string  $stripeLivePublish
 * @property string  $stripeTestSecret
 * @property string  $stripeTestPublish
 * @property string  $websiteName
 * @property boolean $enableStripePayment
 * @property boolean $enableBlog
 * @property string  $blogSubdomain
 */
class SuperCMSSettings extends ApplicationSettings
{
    public function getStripeToken()
    {
        if ($this->developmentMode) {
            return $this->stripeTestSecret;
        }
        return $this->stripeLiveSecret;
    }
}