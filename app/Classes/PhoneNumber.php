<?php

namespace App\Classes;

class PhoneNumber {

    private $phones = [
        [
            'country' => 'Cameroon',
            'code' => '+237',
            'regex' => '/\(237\)\ ?[2368]\d{7,8}$/',
            'regexCode' => '/\(237\)/'
        ],
        [
            'country' => 'Ethiopia',
            'code' => '+251',
            'regex' => '/\(251\)\ ?[1-59]\d{8}$/',
            'regexCode' => '/\(251\)/'
        ],
        [
            'country' => 'Morocco',
            'code' => '+212',
            'regex' => '/\(212\)\ ?[5-9]\d{8}$/',
            'regexCode' => '/\(212\)/'
        ],
        [
            'country' => 'Mozambique',
            'code' => '+258',
            'regex' => '/\(258\)\ ?[28]\d{7,8}$/',
            'regexCode' => '/\(258\)/'
        ],
        [
            'country' => 'Uganda',
            'code' => '+256',
            'regex' => '/\(256\)\ ?\d{9}$/',
            'regexCode' => '/\(256\)/'
        ]
    ];

    private $country;
    private $countryCode;
    private $state;
    private $number;
    
    public function __construct($phoneNumber)
    {
        $this->country = $this->setCountry($phoneNumber);
        $this->countryCode = $this->setCountryCode($phoneNumber);
        $this->state = $this->setState($phoneNumber);
        $this->number = $this->setNumber($phoneNumber);
    }

    public function getCountry(){
        return $this->country;
    }

    private function setCountry($phoneNumber){

        foreach ($this->phones as $value) {

            preg_match($value['regexCode'], $phoneNumber, $matches);

            if ($matches) {
                return $value['country'];
            }
        }

        return "";
        
    }

    public function getCountryCode(){
        return $this->countryCode;
    }

    private function setCountryCode($phoneNumber){

        foreach ($this->phones as $value) {

            preg_match($value['regexCode'], $phoneNumber, $matches);

            if ($matches) {
                return $value['code'];
            }
        }

        return "";
    }

    public function getState(){
        return $this->state;
    }

    private function setState($phoneNumber){

        foreach ($this->phones as $value) {

            preg_match($value['regex'], $phoneNumber, $matches);

            if ($matches) {
                return "OK";
            }
        }

        return "NOK";
    }

    public function getNumber(){
        return $this->number;
    }

    private function setNumber($phoneNumber){
        $keywords = preg_split("/\(\d{3}\) /", $phoneNumber);

        if(isset($keywords[1]))
            return $keywords[1];
        else
            return null;
    }

}