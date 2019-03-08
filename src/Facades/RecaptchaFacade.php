<?php

namespace BinaryCabin\Recaptcha\Facades;

use Illuminate\Support\Facades\Facade;

class RecaptchaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'recaptcha';
    }
}
