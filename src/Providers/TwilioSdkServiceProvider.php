<?php

namespace Innoboxrr\TwilioSdk\Providers;

use Innoboxrr\TwilioSdk\Twilio\WhatsApp;
use Innoboxrr\TwilioSdk\Twilio\Sms;
use Illuminate\Support\ServiceProvider;

class TwilioSdkServiceProvider extends ServiceProvider
{

    public function boot()
    {
        
        if ($this->app->runningInConsole()) {
            
            
        }

    }

    public function register()
    {

        $this->app->bind(WhatsApp::class, function($app) {

            if(!is_null(env('TWILIO_SID')) && !is_null(env('TWILIO_TOKEN'))) {

                $whatsApp = new WhatsApp();

                return $whatsApp->init(['sid' => env('TWILIO_SID'), 'token' => env('TWILIO_TOKEN')]);

            } else {
                
                return new WhatsApp();

            }

        
        });

        $this->app->bind(Sms::class, function($app) {

            if(!is_null(env('TWILIO_SID')) && !is_null(env('TWILIO_TOKEN'))) {

                $whatsApp = new Sms();

                return $whatsApp->init(['sid' => env('TWILIO_SID'), 'token' => env('TWILIO_TOKEN')]);

            } else {
                
                return new Sms();

            }
        
        });

    }

}
