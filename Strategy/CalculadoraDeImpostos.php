<?php

class CalculadoraDeImpostos
{
    public function calcula(Orcamento $orcamento, Imposto $imposto) {
        return $imposto->calcula($orcamento);
    }
}
