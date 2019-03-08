<?php

namespace BinaryCabin\Recaptcha\Providers;

use BinaryCabin\Recaptcha\Recaptcha;
use Illuminate\Support\ServiceProvider;
use BinaryCabin\Recaptcha\Configuration\RecaptchaConfig;

class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addValidator();
        $this->publishes([
            __DIR__.'/../Configuration/Templates/recaptcha.php' => config_path('recaptcha.php'),
        ], 'config');
        $this->loadViewsFrom(__DIR__.'/../views', 'recaptcha');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRecaptcha();
    }

    protected function bindRecaptcha()
    {
        $this->app->bind('recaptcha', function () {
            return new Recaptcha(new RecaptchaConfig());
        });
    }

    /**
     * Extends Validator to include a recaptcha type.
     */
    public function addValidator()
    {
        $this->app->validator->extendImplicit('recaptcha', function ($attribute, $value, $parameters) {
            $recaptcha = app('recaptcha');
            $challenge = app('request')->input($recaptcha->getInputName());

            return $recaptcha->check($challenge, $value);
        }, 'Please ensure that you are a human!');
    }
}
