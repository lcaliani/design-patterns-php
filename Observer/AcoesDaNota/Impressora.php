<?php

class Impressora implements Acao
{
    public function executa(NotaFiscal $notaFiscal)
    {
        echo 'Imprimi a nota fiscal! <br><br>';
    }
}