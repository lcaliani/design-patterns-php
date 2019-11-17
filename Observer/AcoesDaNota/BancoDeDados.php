<?php

class BancoDeDados implements Acao
{
    public function executa(NotaFiscal $notaFiscal)
    {
        echo 'Salvei os dados da nota no banco! <br><br>';
    }
}