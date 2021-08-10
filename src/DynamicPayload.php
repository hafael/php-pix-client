<?php

namespace Hafael\Pix\Client;

class DynamicPayload extends Payload
{
    
    /**
     * Descrição do Pagamento
     * 
     * @var string
     */
    private $description;

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
     * Calendario
     * 
     * @var Calendar
     */
    private $calendar;

    /**
     * Indica se a cobrança deve ser paga uma unica vez
     * 
     * @var boolean
     */
    private $uniquePayment = false;

    /**
     * Indica o URL do Payload dinamico
     * 
     * @var string
     */
    private $url;

    /**
     * Pagador
     * 
     * @var Pagador
     */
    private $payer;

    /**
     * Loc
     * 
     * @var Loc
     */
    private $loc;

    /**
     * Location
     * 
     * @var string
     */
    private $location;

    /**
     * Indica o número da revisão da cobrança
     * 
     * @var integer
     */
    private $review;

    /**
     * Instruçoes de pagamento
     * 
     * @var string
     */
    private $payerInstructions;

    /**
     * Instruçoes de pagamento
     * 
     * @var array
     */
    private $pix = [];

    public function __construct()
    {
        parent::__construct();
        $this->setLoc([]);
        $this->setCalendar(new Calendar([]));
        $this->setAmount(new Amount([]));
        $this->setPayer(new Devedor([]));

    }

    /**
     * Define o valor de description
     * 
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Retorna o valor de description
     * 
     * @return string;
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Define o valor de review
     * 
     * @param integer $review
     */
    public function setReview(int $review)
    {
        $this->review = $review;
        return $this;
    }

    /**
     * Retorna o valor de review
     * 
     * @return integer;
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Define o valor de amount
     * 
     * @param Amount $amount
     */
    public function setAmount(Amount $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Retorna o valor de amount
     * 
     * @return Amount;
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Define o tempo de expiraçao da cobrança em minutos
     * 
     * @param Calendar $expiration
     */
    public function setCalendar(Calendar $calendar)
    {
        $this->calendar = $calendar;
        return $this;
    }

    /**
     * Retorna a data de expiracao da cobrança
     * 
     * @return Calendar;
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Define o pagador
     * 
     * @param Devedor $payer
     */
    public function setPayer(Devedor $payer)
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
     * Define as instruçoes de pagamento para o devedor em solicitacaoPagador
     * 
     * @param string $payerInstructions
     */
    public function setPayerInstructions(string $payerInstructions)
    {
        $this->payerInstructions = $payerInstructions;
        return $this;
    }

    /**
     * Retorna a instrucao do campo solicitacaoPagador
     * 
     * @return string;
     */
    public function getPayerInstructions()
    {
        return $this->payerInstructions;
    }

    /**
     * Define se o pagamento deve ser feito uma unica vez
     * 
     * @param boolean $uniquePayment
     */
    public function setUniquePayment(bool $uniquePayment = true)
    {
        $this->uniquePayment = $uniquePayment;
        return $this;
    }

    /**
     * Retorna a instrução sobre o pagamento unico
     * 
     * @return boolean;
     */
    public function getUniquePayment()
    {
        return $this->uniquePayment;
    }

    /**
     * Define a URL do payload QRCode
     * 
     * @param string $url
     */
    public function setPayloadUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Retorna a URL do QRCode (payload)
     * 
     * @return string;
     */
    public function getPayloadUrl()
    {
        return $this->url;
    }

    /**
     * Define a URL do payload QRCode
     * 
     * @param array $loc
     */
    public function setLoc(array $loc)
    {
        $this->loc = new Loc($loc);
        return $this;
    }

    /**
     * Retorna a URL do QRCode (payload)
     * 
     * @return Loc;
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * Define a URL do payload QRCode
     * 
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Retorna a URL do QRCode (payload)
     * 
     * @return string;
     */
    public function getLocation()
    {
        return $this->location;
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
     * Define a URL do payload QRCode
     * 
     * @param array $payments
     */
    public function setPix($payments)
    {
        if(!empty($payments))
        {
            foreach($payments as $pix)
            {
                $this->pix[] = new Pix($pix);
            }
        }
        return $this;
    }

    /**
     * Retorna a URL do QRCode (payload)
     * 
     * @return array;
     */
    public function getPix()
    {
        return $this->pix;
    }

    /**
     * Retorna a URL do QRCode (payload)
     * 
     * @return array;
     */
    public function getPixAsArray()
    {
        $payments = [];
        foreach($this->pix as $pix)
        {
            $payments[] = $pix->toArray();
        }
        return $payments;
    }

    /**
     * Retorna os valores de merchant
     * 
     * @return string
     */
    public function getMerchantAccountInformation()
    {
        //dominio do banco
        $gui = Value::get(Value::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, $this->getMerchant()->getGui());

        //URL do QRCode Dinamico
        $url = mb_strlen($this->getLocation()) ? Value::get(Value::ID_MERCHANT_ACCOUNT_INFORMATION_URL, preg_replace('/ˆhttps?\:\/\//', '', $this->getLocation()) ) : '';

        //valor completo de merchant account information
        return Value::get(Value::ID_MERCHANT_ACCOUNT_INFORMATION, $gui.$url);
    }


    /**
     * Retorna o payload do QRCode
     * 
     * @return string
     */
    public function toString()
    {

        $uniquePayment = $this->getUniquePayment() ? Value::get(Value::ID_POINT_OF_INITIATION_METHOD, '12') : Value::get(Value::ID_POINT_OF_INITIATION_METHOD, '11');

        $payload = Value::get(Value::ID_PAYLOAD_FORMAT_INDICATOR, '01').
                   $uniquePayment.
                   $this->getMerchantAccountInformation().
                   Value::get(Value::ID_MERCHANT_CATEGORY_CODE, $this->getMerchant()->getCategoryCode()).
                   Value::get(Value::ID_TRANSACTION_CURRENCY, $this->getCurrency()).
                   Value::get(Value::ID_TRANSACTION_AMOUNT, $this->getAmount()->getOriginal()).
                   Value::get(Value::ID_COUNTRY_CODE, $this->getMerchant()->getCountryCode()).
                   Value::get(Value::ID_MERCHANT_NAME, $this->getMerchant()->getName()).
                   Value::get(Value::ID_MERCHANT_CITY, $this->getMerchant()->getCity()).
                   $this->getAdditionalDataFieldTemplate();

        return $payload.$this->getCRC16($payload);
    }


    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toCreate()
    {
        return array_filter([
            'calendario' => $this->getCalendar()->toArray(),
            'devedor' => $this->getPayer()->toArray(),
            'valor' => $this->getAmount()->toArray(),
            'chave' => $this->getPixKey(),
            'solicitacaoPagador' => $this->getPayerInstructions(),
        ]);
    }

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return array_filter([
            'calendario' => $this->getCalendar()->toArray(),
            'txid' => $this->getTxId(),
            'revisao' => $this->getReview(),
            'loc' => $this->getLoc()->toArray(),
            'location' => $this->getLocation(),
            'status' => $this->getStatus(),
            'devedor' => $this->getPayer()->toArray(),
            'valor' => $this->getAmount()->toArray(),
            'chave' => $this->getPixKey(),
            'solicitacaoPagador' => $this->getPayerInstructions(),
            'pix' => $this->getPixAsArray(),
        ], function($val) {
            return $val !== null;
        });
    }

    public function fromArray(array $data)
    {
        $this->setReview($data['revisao'] ?? 0);
        $this->setCalendar(new Calendar($data['calendario'] ?? []));
        $this->setTxId($data['txid'] ?? null);
        $this->setLoc($data['loc'] ?? []);
        $this->setLocation($data['location'] ?? null);
        $this->setStatus($data['status'] ?? null);
        $this->setPayer(new Devedor($data['devedor'] ?? []));
        $this->setAmount(new Amount($data['valor'] ?? []));
        $this->setPixKey($data['chave'] ?? null);
        $this->setPayerInstructions($data['solicitacaoPagador'] ?? null);
        $this->setPix($data['pix'] ?? []);

        return $this;
    }
}