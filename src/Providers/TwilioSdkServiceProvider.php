<?php

namespace Innoboxrr\TwilioSdk\Providers;

use Illuminate\Support\ServiceProvider;
use Innoboxrr\TwilioSdk\Twilio\WhatsApp;
use Innoboxrr\TwilioSdk\Twilio\Sms;
use Innoboxrr\TwilioSdk\Twilio\Rooms;

class TwilioSdkServiceProvider extends ServiceProvider
{

    public function boot()
    {
        
        if ($this->app->runningInConsole()) {
            
            $this->publishes([
                __DIR__.'/../../config/twilio-sdk.php' => config_path('twilio-sdk.php'),
            ], 'config');

        }

    }

    public function register()
    {

        $this->mergeConfigFrom(__DIR__.'/../../config/twilio-sdk.php', 'twilio-sdk');

        $this->app->bind(WhatsApp::class, function($app) {

            if(!is_null(config('twilio-sdk.twilio-sid')) && !is_null(config('twilio-sdk.twilio-token'))) {

                $whatsApp = new WhatsApp();

                return $whatsApp->init(['sid' => config('twilio-sdk.twilio-sid'), 'token' => config('twilio-sdk.twilio-token')]);

            } else {
                
                return new WhatsApp();

            }

        
        });

        $this->app->bind(Sms::class, function($app) {

            if(!is_null(config('twilio-sdk.twilio-sid')) && !is_null(config('twilio-sdk.twilio-token'))) {

                $whatsApp = new Sms();

                return $whatsApp->init(['sid' => config('twilio-sdk.twilio-sid'), 'token' => config('twilio-sdk.twilio-token')]);

            } else {
                
                return new Sms();

            }
        
        });

        $this->app->bind(Rooms::class, function($app) {

            if(
                !is_null(config('twilio-sdk.twilio-sid')) && 
                !is_null(config('twilio-sdk.twilio-token')) && 
                !is_null(config('twilio-sdk.twilio-api-key')) && 
                !is_null(config('twilio-sdk.twilio-api-secret'))
            ) {

                $rooms = new Rooms();

                return $rooms->init([
                    'sid' => config('twilio-sdk.twilio-sid'), 
                    'token' => config('twilio-sdk.twilio-token'),
                    'apiKey' => config('twilio-sdk.twilio-api-key'),
                    'apiSecret' => config('twilio-sdk.twilio-api-secret')
                ]);

            } else {
                
                return new Rooms();

            }
        
        });

    }

}
