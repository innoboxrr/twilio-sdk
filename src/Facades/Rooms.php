<?php

namespace Innoboxrr\TwilioSdk\Facades;

// dEPRECATED

use Illuminate\Support\Facades\Facade;
use Innoboxrr\TwilioSdk\Twilio\Rooms as RoomsClass;

class Rooms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return RoomsClass::class;
    }
}
