<?php

namespace Hafael\Pix\Client;

class Pagador 
{
    /**
     * A chave Pix registrada no DICT que será utilizada identificar o pagador do Pix
     * 
     * @var string
     */
    private $key;

    /**
     * Informação do pagador sobre o Pix a ser enviado
     * 
     * @var string
     */
    private $payerInstructions;

    public function __construct(array $data)
    {
        $this->fromArray($data);
    }

    /**
     * Define 
     * 
     * @param array $data
     */
    public function fromArray(array $data)
    {
        $pagador = Pagador::class;

        $pagador::setPixKey($data['chave'] ?? null);
        
        if(!empty($data['infoPagador']))
        {
            $pagador::setPayerInstructions($data['infoPagador']);
        }
        
        return $pagador;
    }

    /**
     * Define a chave pix
     * 
     * @param string $key
     */
    public function setPixKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Retorna a chave pix
     * 
     * @return string;
     */
    public function getPixKey()
    {
        return $this->key;
    }

    /**
     * Informação do pagador sobre o Pix a ser enviado
     * 
     * @param string $payerInstructions
     */
    public function setPayerInstructions($payerInstructions)
    {
        $this->payerInstructions = $payerInstructions;
        return $this;
    }

    /**
     * Retorna as instruções para o pagador
     * 
     * @return string;
     */
    public function getPayerInstructions()
    {
        return $this->payerInstructions;
    }
    
    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return [
            'chave' => $this->getPixKey(),
            'infoPagador' => $this->getPayerInstructions()
        ];
    }
}