<?php

namespace Innoboxrr\TwilioSdk\Facades;

use Illuminate\Support\Facades\Facade;
use Innoboxrr\TwilioSdk\Twilio\Sms as SmsClass;

class Sms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SmsClass::class;
    }
}
