<?php

class ItemDaNota
{
    /**
     * Descrição do item
     *
     * @var string
     */
    private $descricao;

    /**
     * Valor do item
     *
     * @var float
     */
    private $valor;

    public function __construct(string $descricao = '', float $valor = 0.0)
    {
        $this->descricao = $descricao;
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }
}