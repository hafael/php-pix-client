<?php

namespace Hafael\Pix\Client;

use DateTime;

class Loc 
{
    /**
     * Identificador do registro da cobrança
     * 
     * @var integer
     */
    private $id;

    /**
     * URL que serve o payload da representação da cobrança
     * 
     * @var string
     */
    private $location;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var string
     */
    private $tipoCob;

    /**
     * Data de criação do registro da cobrança no PSP
     * 
     * @var \Datetime
     */
    private $creation;

    public function __construct(array $loc)
    {
        $this->setId($loc['id'] ?? null);
        $this->setLocation($loc['location'] ?? null);
        $this->setTipoCob($loc['tipoCob'] ?? null);
        $this->setCreationDate($loc['criacao'] ?? null);
    }

    /**
     * Define
     * 
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return integer;
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Define
     * 
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Define
     * 
     * @param string $tipoCob
     */
    public function setTipoCob($tipoCob)
    {
        $this->tipoCob = $tipoCob;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getTipoCob()
    {
        return $this->tipoCob;
    }

    /**
     * Define
     * 
     * @param string $creation
     */
    public function setCreationDate($creation)
    {
        $this->creation = mb_strlen($creation) ? new DateTime($creation) : null;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getCreationDate()
    {
        return $this->creation ? $this->creation->format(DateTime::RFC3339) : null;
    }

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        $response = array_filter([
            'id' => $this->getId(),
            'location' => $this->getLocation(),
            'tipoCob' => $this->getTipoCob(),
            'criacao' => $this->getCreationDate(),
        ]);

        return empty($response) ? null : $response;
    }
}