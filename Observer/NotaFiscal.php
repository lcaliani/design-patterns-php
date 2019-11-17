<?php

class NotaFiscal
{
    // public somente para visualização
    public $razaoSocial;
    public $cnpj;
    public $valorBruto;
    public $dataDeEmissao;
    public $observacoes;

    public function __construct(
        $razaoSocial,
        $cnpj,
        $valorBruto,
        $dataDeEmissao,
        $observacoes
    ) {
        $this->razaoSocial = $razaoSocial;
        $this->cnpj = $cnpj;
        $this->valorBruto = $valorBruto;
        $this->dataDeEmissao = $dataDeEmissao;
        $this->observacoes = $observacoes;
    }
}