<?php

namespace Innoboxrr\TwilioSdk\Facades;

use Illuminate\Support\Facades\Facade;
use Innoboxrr\TwilioSdk\Twilio\WhatsApp as WhatsAppClass;

class WhatsApp extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return WhatsAppClass::class;
    }
}
