<?php

namespace Hafael\Pix\Client;

use DateTime;

class Calendar 
{
    /**
     * Identificador do registro da cobrança
     * 
     * @var \Datetime
     */
    private $criacao;

    /**
     * Identificador do registro da cobrança
     * 
     * @var integer
     */
    private $expiracao;

    /**
     * URL que serve o payload da representação da cobrança
     * 
     * @var \Datetime
     */
    private $apresentacao;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var \Datetime
     */
    private $dataDeVencimento;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var integer
     */
    private $validadeAposVencimento;


    public function __construct(array $data)
    {
        $this->setCriacao($data['criacao'] ?? null);
        $this->setExpiracao($data['expiracao'] ?? null);
        $this->setApresentacao($data['apresentacao'] ?? null);
        $this->setDataDeVencimento($data['dataDeVencimento'] ?? null);
        $this->setValidadeAposVencimento($data['validadeAposVencimento'] ?? 0);
    }
    
    private function setDate(string $date = null)
    {
        return mb_strlen($date) ? new DateTime($date) : null;
    }

    private function getDate(\Datetime $date)
    {
        return  $date->format(DateTime::RFC3339);
    }

    /**
     * Define
     * 
     * @param string $criacao
     */
    public function setCriacao($criacao)
    {
        $this->criacao = $this->setDate($criacao);
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getCriacao()
    {
        return $this->criacao ? $this->getDate($this->criacao) : null;
    }

    /**
     * Define
     * 
     * @param integer $expiracao
     */
    public function setExpiracao($expiracao = 3600)
    {
        $this->expiracao = $expiracao;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return integer;
     */
    public function getExpiracao()
    {
        return $this->expiracao;
    }

    /**
     * Define
     * 
     * @param string $apresentacao
     */
    public function setApresentacao($apresentacao)
    {
        $this->apresentacao = $this->setDate($apresentacao);
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getApresentacao()
    {
        return $this->apresentacao ? $this->getDate($this->apresentacao) : null;
    }

    /**
     * Define
     * 
     * @param string $dataDeVencimento
     */
    public function setDataDeVencimento($dataDeVencimento)
    {
        $this->dataDeVencimento = $this->setDate($dataDeVencimento);
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getDataDeVencimento()
    {
        return $this->dataDeVencimento ? $this->getDate($this->dataDeVencimento) : null;
    }

    /**
     * Define
     * 
     * @param integer $validade
     */
    public function setValidadeAposVencimento($validadeAposVencimento = 0)
    {
        $this->validadeAposVencimento = $validadeAposVencimento;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return integer;
     */
    public function getValidadeAposVencimento()
    {
        return $this->validadeAposVencimento;
    }

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return array_filter([
            'criacao' => $this->getCriacao(),
            'expiracao' => $this->getExpiracao(),
            'apresentacao' => $this->getApresentacao(),
            'dataDeVencimento' => $this->getDataDeVencimento(),
            'validadeAposVencimento' => $this->getValidadeAposVencimento(),
        ]);
    }
}