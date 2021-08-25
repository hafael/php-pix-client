<?php

namespace Hafael\Pix\Client;

class ContaBanco 
{
    const DOC_CPF = 'cpf';
    const DOC_CNPJ = 'cnpj';

    const CHECKING_ACCOUNT = 'cacc';
    const SAVINGS_ACCOUNT = 'svgs';

    /**
     * Número do documento
     * 
     * @var string
     */
    private $documentNumber;

    /**
     * Modelo de documento
     * 
     * @var string
     */
    private $documentModel;

    /**
     * Nome do titular
     * 
     * @var string
     */
    private $name;

    /**
     * Código do banco
     * 
     * @var string
     */
    private $code;

    /**
     * Número da agência bancária
     * 
     * @var string
     */
    private $routingNumber;

    /**
     * Número da conta bancária
     * 
     * @var string
     */
    private $accountNumber;

    /**
     * Tipo da conta do recebedor no seu Banco
     * "cacc" ou "svgs"
     * 
     * @var string
     */
    private $accountType;

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
        $conta = ContaBanco::class;

        $conta::setName($data['nome'] ?? null);
        $conta::setCode($data['codigoBanco'] ?? null);
        $conta::setRoutingNumber($data['agencia'] ?? null);
        $conta::setAccountNumber($data['conta'] ?? null);
        $conta::setAccountType($data['tipoConta'] ?? null);
        
        if(!empty($data[self::DOC_CPF]))
        {
            $conta::setDocumentModel(self::DOC_CPF);
            $conta::setDocumentNumber($data[self::DOC_CPF]);
        }else if(!empty($data[self::DOC_CNPJ])){
            $conta::setDocumentModel(self::DOC_CNPJ);
            $conta::setDocumentNumber($data[self::DOC_CNPJ]);
        }
        
        return $conta;
    }

    /**
     * Define o número do documento
     * 
     * @param string $pixkey
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;
        return $this;
    }

    /**
     * Retorna o número do documento
     * 
     * @return string;
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * Define o modelo do documento
     * CPF|CNPJ
     * 
     * @param string $documentModel
     */
    public function setDocumentModel($documentModel)
    {
        $this->documentModel = $documentModel;
        return $this;
    }

    /**
     * Retorna o modelo do documento
     * CPF|CNPJ
     * 
     * @return string;
     */
    public function getDocumentModel()
    {
        return $this->documentModel;
    }

    /**
     * Define o nome do pagador
     * 
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Retorna o nome do pagador
     * 
     * @return string;
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Define o código do banco
     * 
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Retorna o código o banco
     * 
     * @return string;
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Define o número da agencia
     * 
     * @param string $routingNumber
     */
    public function setRoutingNumber($routingNumber)
    {
        $this->routingNumber = $routingNumber;
        return $this;
    }

    /**
     * Retorna o numero da agencia
     * 
     * @return string;
     */
    public function getRoutingNumber()
    {
        return $this->routingNumber;
    }

    /**
     * Define o número da conta
     * 
     * @param string $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * Retorna o numero da conta
     * 
     * @return string;
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Define o tipo da conta (corrente ou poupança)
     * 
     * @param string $accountType
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;
        return $this;
    }

    /**
     * Retorna o numero da conta
     * 
     * @return string;
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    
    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return [
            $this->getDocumentModel() => $this->getDocumentNumber(),
            'nome' => $this->getName(),
            'codigoBanco' => $this->getCode(),
            'agencia' => $this->getRoutingNumber(),
            'conta' => $this->getAccountNumber(),
            'tipoConta' => $this->getAccountType()
        ];
    }
}