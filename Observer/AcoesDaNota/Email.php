<?php

class Email implements Acao
{
    public function executa(NotaFiscal $notaFiscal)
    {
        echo 'Enviei o e-mail com as informações da nota! <br><br>';
    }
}