<?php

namespace Hafael\Pix\Client;

class Favorecido 
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
     * @var ContaBanco
     */
    private $bankAccount;

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
        $pagador = Favorecido::class;

        if(!empty($data['chave']))
        {
            $pagador::setPixKey($data['chave'] ?? null);
        }else {
            $pagador::setBankAccount(new ContaBanco($data['contaBanco']));
        }
        
        return $pagador;
    }

    /**
     * Define a chave pix do favorecido
     * 
     * @param string $key
     */
    public function setPixKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Retorna a chave pix do favorecido
     * 
     * @return string;
     */
    public function getPixKey()
    {
        return $this->key;
    }

    /**
     * Define a conta bancaria do favorecido
     * 
     * @param ContaBanco $bankAccount
     */
    public function setBankAccount(ContaBanco $bankAccount)
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    /**
     * Retorna a conta bancária do favorecido
     * 
     * @return string;
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }
    
    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {

        if(!empty($this->getPixKey()))
        {
            return [
                'chave' => $this->getPixKey(),
            ];
        }

        return [
            'contaBanco' => $this->getBankAccount()->toArray(),
        ];
    }
}