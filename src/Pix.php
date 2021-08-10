<?php

namespace Hafael\Pix\Client;

use DateTime;

class Pix 
{
    /**
     * Identificador do registro da cobrança
     * 
     * @var string
     */
    private $endToEndId;

    /**
     * URL que serve o payload da representação da cobrança
     * 
     * @var string
     */
    private $txId;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var float
     */
    private $valor;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var \Datetime
     */
    private $horario;

    public function __construct(array $data)
    {
        $this->setEndToEndId($data['endToEndId'] ?? null);
        $this->setTxId($data['txid'] ?? null);
        $this->setValor($data['valor'] ?? 0);
        $this->setHorario($data['horario'] ?? null);
    }
    
    private function formatNumber($number)
    {
        return (string) number_format($number, 2, '.', '');
    }

    /**
     * Define
     * 
     * @param string $endToEndId
     */
    public function setEndToEndId($endToEndId)
    {
        $this->endToEndId = $endToEndId;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getEndToEndId()
    {
        return $this->endToEndId;
    }

    /**
     * Define
     * 
     * @param string $txId
     */
    public function setTxId($txId)
    {
        $this->txId = $txId;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getTxId()
    {
        return $this->txId;
    }

    /**
     * Define
     * 
     * @param float $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getValor()
    {
        return $this->formatNumber($this->valor);
    }

    /**
     * Define
     * 
     * @param string $horario
     */
    public function setHorario($horario)
    {
        $this->horario = mb_strlen($horario) ? new DateTime($horario) : null;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getHorario()
    {
        return $this->horario ? $this->horario->format(DateTime::RFC3339) : null;
    }

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return array_filter([
            'endToEndId' => $this->getEndToEndId(),
            'txid' => $this->getTxId(),
            'valor' => $this->getValor(),
            'horario' => $this->getHorario(),
        ]);
    }
}