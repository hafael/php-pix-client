<?php

namespace Hafael\Pix\Client\Contracts;

use Hafael\Pix\Client\Amount;
use Hafael\Pix\Client\Devedor;
use Hafael\Pix\Client\Merchant;
use Hafael\Pix\Client\Pagador;

interface PayloadInterface
{
    /**
     * Define o valor da chave pix
     * 
     * @param string $pixkey
     */
    public function setPixKey(string $pixKey);

    /**
     * Retorna o valor de pixKey
     * 
     * @return string;
     */
    public function getPixKey();

    /**
     * Define o valor de description
     * 
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * Retorna o valor de description
     * 
     * @return string;
     */
    public function getDescription();

    /**
     * Define o valor de merchant
     * 
     * @param Merchant $merchant
     */
    public function setMerchant(Merchant $merchant);

    /**
     * Retorna o valor de merchant
     * 
     * @return Merchant;
     */
    public function getMerchant();

    /**
     * Define o valor de transaction id txId
     * 
     * @param string $merchantCity
     */
    public function setTxId(string $txId);

    /**
     * Retorna o valor de merchant city
     * 
     * @return string;
     */
    public function getTxId();

    /**
     * Define o valor de currency
     * 
     * @param string $currency
     */
    public function setCurrency($currency);

    /**
     * Retorna o valor de currency
     * 
     * @return string;
     */
    public function getCurrency();

    /**
     * Define o tempo de expiraçao da cobrança em minutos
     * 
     * @param integer $expiration
     */
    public function setExpiration(int $expiration);

    /**
     * Retorna a data de expiracao da cobrança
     * 
     * @return integer;
     */
    public function getExpiration();

    /**
     * Define o pagador
     * 
     * @param Pagador $payer
     */
    public function setPayer(Pagador $payer);

    /**
     * Retorna o devedor da cobrança
     * 
     * @return Devedor;
     */
    public function getPayer();

    /**
     * Define as instruçoes de pagamento para o devedor em solicitacaoPagador
     * 
     * @param string $payerInstructions
     */
    public function setPayerInstructions(string $payerInstructions);

    /**
     * Retorna a instrucao do campo solicitacaoPagador
     * 
     * @return string;
     */
    public function getPayerInstructions();

    /**
     * Define se o pagamento deve ser feito uma unica vez
     * 
     * @param boolean $uniquePayment
     */
    public function setUniquePayment(bool $uniquePayment = true);

    /**
     * Retorna a instrução sobre o pagamento unico
     * 
     * @return boolean;
     */
    public function getUniquePayment();

    /**
     * Define a URL do payload QRCode
     * 
     * @param string $url
     */
    public function setPayloadUrl(string $url);

    /**
     * Retorna a URL do QRCode (payload)
     * 
     * @return string;
     */
    public function getPayloadUrl();

    /**
     * Retorna os valores de merchant
     * 
     * @return string
     */
    public function getMerchantAccountInformation();

    /**
     * Retorna os valores adicionais do pix
     * 
     * @return string
     */
    public function getAdditionalDataFieldTemplate();

    /**
     * Método responsável por calcular o valor da hash de validação do código pix
     * @return string
     */
    public function getCRC16($payload);

    /**
     * Retorna o payload do QRCode
     * 
     * @return string
     */
    public function toString();

    public function toBase64($width = 300);
    
    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray();

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function fromArray(array $data);

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toCreate();
}