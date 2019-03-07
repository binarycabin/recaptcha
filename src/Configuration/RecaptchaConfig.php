<?php

namespace BinaryCabin\Recaptcha\Configuration;

class RecaptchaConfig
{
    private $recaptchaEnabled = true;
    private $recaptchaVersion = '3';
    private $recaptchaSiteKey = null;
    private $recaptchaSecretKey = null;

    public function __construct() {
        $configArray = app('config')->get('recaptcha');
        if(isset($configArray['enable'])){
            $this->recaptchaEnabled = $configArray['enable'];
        }
        if(isset($configArray['version'])){
            $this->recaptchaVersion = $configArray['version'];
        }
        if(!empty($configArray['site_key'])){
            $this->recaptchaSiteKey = $configArray['site_key'];
        }
        if(!empty($configArray['secret_key'])){
            $this->recaptchaSecretKey = $configArray['secret_key'];
        }
    }
    public function getRecaptchaEnabled()
    {
        return $this->recaptchaEnabled;
    }

    public function getRecaptchaVersion()
    {
        return $this->recaptchaVersion;
    }

    public function getRecaptchaSiteKey()
    {
        return $this->recaptchaSiteKey;
    }

    public function getRecaptchaSecretKey()
    {
        return $this->recaptchaSecretKey;
    }

}
