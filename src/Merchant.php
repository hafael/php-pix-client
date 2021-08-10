<?php

namespace Hafael\Pix\Client;

class Merchant 
{
    /**
     * Número do documento
     * 
     * @var string
     */
    private $gui = 'br.gov.bcb.pix';

    /**
     * Modelo de documento
     * 
     * @var string
     */
    private $key;

    /**
     * Nome do pagador
     * 
     * @var string
     */
    private $name;

    /**
     * Nome do pagador
     * 
     * @var string
     */
    private $city;

    /**
     * Nome do pagador
     * 
     * @var string
     */
    private $postalCode;

    /**
     * Nome do pagador
     * 
     * @var string
     */
    private $countryCode = 'BR';

    /**
     * Nome do pagador
     * 
     * @var string
     */
    private $categoryCode = '0000';


    public function __construct($pixKey = null)
    {
        if(mb_strlen($pixKey)) $this->setKey($pixKey);
    }

    /**
     * Define
     * 
     * @param string $gui
     */
    public function setGui(string $gui)
    {
        $this->gui = $gui;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getGui()
    {
        return $this->gui;
    }

    /**
     * Define
     * 
     * @param string $key
     */
    public function setKey(string $key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Define
     * 
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Define
     * 
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Define
     * 
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Define
     * 
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Define
     * 
     * @param string $categoryCode
     */
    public function setCategoryCode(string $categoryCode)
    {
        $this->categoryCode = $categoryCode;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getCategoryCode()
    {
        return str_pad($this->categoryCode, 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return [
            'gui' => $this->getGui(),
            'key' => $this->getKey(),
            'name' => $this->getName(),
            'categoryCode' => $this->getCategoryCode(),
            'city' => $this->getCity(),
            'postalCode' => $this->getPostalCode(),
            'countryCode' => $this->getCountryCode(),
        ];
    }
}