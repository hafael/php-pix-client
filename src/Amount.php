<?php

namespace Hafael\Pix\Client;

class Amount 
{
    /**
     * Identificador do registro da cobrança
     * 
     * @var float
     */
    private $original;

    /**
     * URL que serve o payload da representação da cobrança
     * 
     * @var float
     */
    private $abatimento;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var float
     */
    private $desconto;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var float
     */
    private $juros;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var float
     */
    private $multa;

    /**
     * Descreve o tipo da cobrança
     * 
     * @var float
     */
    private $final;

    public function __construct(array $data)
    {
        $this->setOriginal($data['original'] ?? 0);
        $this->setAbatimento($data['abatimento'] ?? 0);
        $this->setDesconto($data['desconto'] ?? 0);
        $this->setJuros($data['juros'] ?? 0);
        $this->setMulta($data['multa'] ?? 0);
        $this->setFinal($data['final'] ?? 0);
    }
    
    private function formatNumber($number)
    {
        return (string) number_format($number, 2, '.', '');
    }

    /**
     * Define
     * 
     * @param float $original
     */
    public function setOriginal(float $original)
    {
        $this->original = $original;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getOriginal()
    {
        return $this->formatNumber($this->original);
    }

    /**
     * Define
     * 
     * @param float $abatimento
     */
    public function setAbatimento(float $abatimento)
    {
        $this->abatimento = $abatimento;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getAbatimento()
    {
        return $this->formatNumber($this->abatimento);
    }

    /**
     * Define
     * 
     * @param float $desconto
     */
    public function setDesconto(float $desconto)
    {
        $this->desconto = $desconto;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getDesconto()
    {
        return $this->formatNumber($this->desconto);
    }

    /**
     * Define
     * 
     * @param float $juros
     */
    public function setJuros(float $juros)
    {
        $this->juros = $juros;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getJuros()
    {
        return $this->formatNumber($this->juros);
    }

    /**
     * Define
     * 
     * @param float $multa
     */
    public function setMulta(float $multa)
    {
        $this->multa = $multa;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getMulta()
    {
        return $this->formatNumber($this->multa);
    }

    /**
     * Define
     * 
     * @param float $final
     */
    public function setFinal(float $final)
    {
        $this->multa = $final;
        return $this;
    }

    /**
     * Retorna 
     * 
     * @return string;
     */
    public function getFinal()
    {
        return $this->formatNumber($this->final);
    }

    /**
     * Retorna o payload do QRCode no formato array
     */
    public function toArray()
    {
        return array_filter([
            'original' => $this->getOriginal(),
            'abatimento' => $this->getAbatimento(),
            'desconto' => $this->getDesconto(),
            'juros' => $this->getJuros(),
            'multa' => $this->getMulta(),
            'final' => $this->getFinal(),
        ], function($valor) {
            return (float) $valor;
        });
    }
}