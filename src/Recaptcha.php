<?php

namespace BinaryCabin\Recaptcha;

use BinaryCabin\Recaptcha\Configuration\RecaptchaConfig;

class Recaptcha
{

    protected $config = [ ];

    public function __construct(RecaptchaConfig $config)
    {
        $this->config  = $config;
    }

    /**
     * Render the recaptcha scripts
     *
     * @param array $options
     *
     * @return view
     */
    public function scripts($options = []){
        if(!$this->config->getRecaptchaEnabled()){
            return null;
        }
        $data = [
            'siteKey' => $this->config->getRecaptchaSiteKey(),
            'options'    => $options,
        ];
        return app('view')->make('recaptcha::scripts', $data);
    }

    /**
     * Render the recaptcha scripts
     *
     * @param array $options
     *
     * @return view
     */
    public function hiddenInput($options = []){
        if(!$this->config->getRecaptchaEnabled()){
            return null;
        }
        $data = [
            'siteKey' => $this->config->getRecaptchaSiteKey(),
            'options'    => $options,
        ];
        return app('view')->make('recaptcha::hidden-input', $data);
    }

    /**
     * Call out to reCAPTCHA and process the response
     *
     * @param string $challenge
     * @param string $response
     *
     * @return bool
     */
    public function check($challenge, $response)
    {
        if(!$this->config->getRecaptchaEnabled()){
            return true;
        }
        $parameters = http_build_query([
            'secret'   => value(app('config')->get('recaptcha.secret_key')),
            'remoteip' => app('request')->getClientIp(),
            'response' => $response,
        ]);
        $url           = 'https://www.google.com/recaptcha/api/siteverify?' . $parameters;
        $checkResponse = null;
        // prefer curl, but fall back to file_get_contents
        if ('curl' === app('config')->get('recaptcha.driver') && function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, app('config')->get('recaptcha.options.curl_timeout', 1));
            if(app('config')->get('recaptcha.options.curl_verify') === false) {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            }
            $checkResponse = curl_exec($curl);
            if(false === $checkResponse) {
                app('log')->error('[Recaptcha] CURL error: '.curl_error($curl));
            }
        } else {
            $checkResponse = file_get_contents($url);
        }
        if (is_null($checkResponse) || empty( $checkResponse )) {
            return false;
        }
        $decodedResponse = json_decode($checkResponse, true);
        return $decodedResponse['success'];
    }

    public function getInputName()
    {
        return 'recaptcha-token-input';
    }

}