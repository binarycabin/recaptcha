# Recaptcha

[![Build Status](https://travis-ci.org/binarycabin/recaptcha.svg?branch=master)](https://travis-ci.org/binarycabin/recaptcha)
[![StyleCI](https://github.styleci.io/repos/174383040/shield?branch=master)](https://github.styleci.io/repos/174383040)
[![Latest Stable Version](http://img.shields.io/packagist/v/binarycabin/recaptcha.svg?style=flat)](https://packagist.org/packages/binarycabin/recaptcha)
[![Total Downloads](http://img.shields.io/packagist/dt/binarycabin/recaptcha.svg?style=flat)](https://packagist.org/packages/binarycabin/recaptcha)

A laravel package for easy ReCAPTCHA integration

## Installation

```
composer require binarycabin/recaptcha
```

Publish your configuration file

```
php artisan vendor:publish --provider="BinaryCabin\Recaptcha\Providers\RecaptchaServiceProvider" --tag="config"
```

Update your environment variables:

```
RECAPTCHA_VERSION=3
RECAPTCHA_SITE_KEY=""
RECAPTCHA_SECRET_KEY=""
```

For local sites or test environments you can also disable recaptcha verification using:

```
RECAPTCHA_ENABLE=false
```

## Usage

At the end of your page, add the scripts needed for Google Recaptcha:

```
{!! Recaptcha::scripts() !!}
```

And within your form, add the hidden input that will contain your recaptcha token:

```
{!! Recaptcha::hiddenInput() !!}
```

Finally, add the validation in your controller:

```php
$this->validate($request, [
    'recaptcha-token' => 'recaptcha',
]);
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
