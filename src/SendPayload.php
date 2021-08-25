<?php

namespace Hafael\Pix\Client;

class SendPayload extends Payload
{
    
    /**
     * Status da cobrança
     * 
     * @var string
     */
    private $status;

    /**
     * Valor da transação
     * 
     * @var Amount
     */
    private $amount;

    /**
     * Pagador
     * 
     * @var Pagador
     */
    private $payer;

    /**
     * Pagador
     * 
     * @var Favorecido
     */
    private $receiver;

    public function __construct()
    {
        parent::__construct();
        $this->setAmount("0.00");

    }


    /**
     * Define o valor da transferencia
     * 
     * @param string|int|float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Retorna o valor da transferencia
     * 
     * @return Amount;
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Define o pagador
     * 
     * @param Pagador $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * Retorna o devedor da cobrança
     * 
     * @return Devedor;
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Define o favorecido da transferencia
     * 
     * @param Favorecido $payer
     */
    public function setReceiver(Favorecido $receiver)
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * Retorna o favorecido da transferencia
     * 
     * @return Devedor;
     */
    public function getReceiver()
    {
        return $this->receiver;
    }


    /**
     * Define a URL do payload QRCode
     * 
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Retorna a URL do QRCode (payload)
     * 
     * @return string;
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toCreate()
    {
        return array_filter([
            'pagador' => $this->getPayer()->toArray(),
            'valor' => $this->getAmount(),
            'favorecido' => $this->getReceiver()->toArray(),
        ]);
    }

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return array_filter([
            'status' => $this->getStatus(),
            'pagador' => $this->getPayer()->toArray(),
            'favorecido' => $this->getReceiver()->toArray(),
            'valor' => $this->getAmount(),
        ], function($val) {
            return $val !== null;
        });
    }

    public function fromArray(array $data)
    {
        $this->setStatus($data['status'] ?? null);
        $this->setPayer(new Pagador($data['pagador'] ?? []));
        $this->setReceiver(new Favorecido($data['favorecido'] ?? []));
        $this->setAmount(new Amount($data['valor'] ?? []));

        return $this;
    }
}