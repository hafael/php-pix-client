<?php

namespace Hafael\Pix\Client;

class Devedor 
{
    const DOC_CPF = 'cpf';
    const DOC_CNPJ = 'cnpj';

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
     * Nome do pagador
     * 
     * @var string
     */
    private $name;

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
        $devedor = Devedor::class;

        $devedor::setName($data['nome'] ?? null);
        
        if(!empty($data[self::DOC_CPF]))
        {
            $devedor::setDocumentModel(self::DOC_CPF);
            $devedor::setDocumentNumber($data[self::DOC_CPF]);
        }else if(!empty($data[self::DOC_CNPJ])){
            $devedor::setDocumentModel(self::DOC_CNPJ);
            $devedor::setDocumentNumber($data[self::DOC_CNPJ]);
        }
        
        return $devedor;
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
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return [
            $this->getDocumentModel() => $this->getDocumentNumber(),
            'nome' => $this->getName()
        ];
    }
}