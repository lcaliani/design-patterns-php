<?php

class Orcamento {
    private $valor;

    public function __construct($novoValor)
    {
        $this->valor = $novoValor;
    }

    public function getValor()
    {
        return $this->valor;
    }
}
