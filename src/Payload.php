<?php

namespace Hafael\Pix\Client;

use Hafael\Pix\Client\Contracts\PayloadInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Payload implements PayloadInterface
{
    
    /**
     * Descrição do Pagamento
     * 
     * @var string
     */
    private $description;

    /**
     * Dados do titular da chave
     * 
     * @var Merchant
     */
    private $merchant;

    /**
     * ID da Transação PIX
     * 
     * @var string
     */
    private $txId;

    /**
     * Moeda corrente da transação
     * 
     * @var string
     */
    private $currency = '986';

    /**
     * Tempo de expiracao da cobrança em segundos
     * a partir da data de criacao
     * 
     * @var integer
     */
    private $expiration;

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
     * Instruçoes de pagamento
     * 
     * @var string
     */
    private $payerInstructions;

    public function __construct()
    {
        $this->setMerchant(new Merchant);
    }

    /**
     * Define o valor da chave pix
     * 
     * @param string $pixkey
     */
    public function setPixKey(string $pixKey)
    {
        $this->merchant->setKey($pixKey);
        return $this;
    }

    /**
     * Retorna o valor de pixKey
     * 
     * @return string;
     */
    public function getPixKey()
    {
        return $this->merchant->getKey();
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
     * Define o valor de merchant
     * 
     * @param Merchant $merchant
     */
    public function setMerchant(Merchant $merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * Retorna o valor de merchant
     * 
     * @return Merchant;
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * Define o valor de transaction id txId
     * 
     * @param string $merchantCity
     */
    public function setTxId(string $txId)
    {
        $this->txId = $txId;
        return $this;
    }

    /**
     * Retorna o valor de merchant city
     * 
     * @return string;
     */
    public function getTxId()
    {
        return $this->txId;
    }

    /**
     * Define o valor de currency
     * 
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = (string) $currency;
        return $this;
    }

    /**
     * Retorna o valor de currency
     * 
     * @return string;
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Define o tempo de expiraçao da cobrança em minutos
     * 
     * @param integer $expiration
     */
    public function setExpiration(int $expiration)
    {
        $this->expiration = $expiration;
        return $this;
    }

    /**
     * Retorna a data de expiracao da cobrança
     * 
     * @return integer;
     */
    public function getExpiration()
    {
        return $this->expiration;
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
     * Retorna os valores de merchant
     * 
     * @return string
     */
    public function getMerchantAccountInformation()
    {
        //dominio do banco
        $gui = Value::get(Value::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, $this->getMerchant()->getGui());

        //chave pix
        $key = mb_strlen($this->getMerchant()->getKey()) ? Value::get(Value::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->getMerchant()->getKey()) : '';

        //descricao do pagamento
        $description = mb_strlen($this->getDescription()) ? Value::get(Value::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION, $this->getDescription()) : '';

        //valor completo de merchant account information
        return Value::get(Value::ID_MERCHANT_ACCOUNT_INFORMATION, $gui.$key.$description);
    }

    /**
     * Retorna os valores adicionais do pix
     * 
     * @return string
     */
    public function getAdditionalDataFieldTemplate()
    {
        //txid
        $txId = Value::get(Value::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID, $this->getTxId());

        return Value::get(Value::ID_ADDITIONAL_DATA_FIELD_TEMPLATE, $txId);
    }

    /**
     * Método responsável por calcular o valor da hash de validação do código pix
     * @return string
     */
    public function getCRC16($payload) {
        //ADICIONA DADOS GERAIS NO PAYLOAD
        $payload .= Value::ID_CRC16.'04';

        //DADOS DEFINIDOS PELO BACEN
        $polinomio = 0x1021;
        $resultado = 0xFFFF;

        //CHECKSUM
        if (($length = strlen($payload)) > 0) {
            for ($offset = 0; $offset < $length; $offset++) {
                $resultado ^= (ord($payload[$offset]) << 8);
                for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                    if (($resultado <<= 1) & 0x10000) $resultado ^= $polinomio;
                    $resultado &= 0xFFFF;
                }
            }
        }

        //RETORNA CÓDIGO CRC16 DE 4 CARACTERES
        return Value::ID_CRC16.'04'.strtoupper(dechex($resultado));
    }

    /**
     * Retorna o payload do QRCode
     * 
     * @return string
     */
    public function toString()
    {

        $payload = Value::get(Value::ID_PAYLOAD_FORMAT_INDICATOR, '01').
                   $this->getMerchantAccountInformation().
                   Value::get(Value::ID_MERCHANT_CATEGORY_CODE, $this->getMerchant()->getCategoryCode()).
                   Value::get(Value::ID_TRANSACTION_CURRENCY, $this->getCurrency()).
                   Value::get(Value::ID_COUNTRY_CODE, $this->getMerchant()->getCountryCode()).
                   Value::get(Value::ID_MERCHANT_NAME, $this->getMerchant()->getName()).
                   Value::get(Value::ID_MERCHANT_CITY, $this->getMerchant()->getCity()).
                   $this->getAdditionalDataFieldTemplate();

        return $payload.$this->getCRC16($payload);
    }

    public function toBase64($width = 300)
    {
        $qrcode = QrCode::format('png')
                        ->size($width)
                        ->color(0, 0, 0)
                        ->generate($this->toString());
        
        return "data:image/png;base64, ".base64_encode($qrcode);
    }
    
    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return [
            'calendario' => [
                'expiracao' => $this->getExpiration(),
            ],
            'devedor' => $this->getPayer()->toArray(),
            'valor' => [
                'original' => $this->getAmount()
            ],
            'chave' => $this->getPixKey(),
            'solicitacaoPagador' => $this->getPayerInstructions()
        ];
    }

    public function fromArray(array $data)
    {
        
    }

    public function toCreate()
    {
        
    }
}