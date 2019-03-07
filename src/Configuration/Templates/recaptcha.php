<?php

return [

    'enable' => env('RECAPTCHA_ENABLE', true),

    'version' => env('RECAPTCHA_VERSION', 3),

    'site_key' => env('RECAPTCHA_SITE_KEY', null),

    'secret_key' => env('RECAPTCHA_SECRET_KEY', null),

];