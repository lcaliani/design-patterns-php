<?php

class NotaFiscalBuilder
{
    private $razaoSocial;
    private $cnpj;
    private $dataDeEmissao;
    private $itensDaNota = [];
    private $valorBruto = 0;
    private $observacoes;

    private $acoesDaNota = [];

    public function comRazaoSocial($razaoSocial) 
    {
        $this->razaoSocial = $razaoSocial; 
    }

    public function comCnpj($cnpj) 
    {
        $this->cnpj = $cnpj; 
    }

    public function comObservacoes($observacoes = '') 
    {
        $this->observacoes = $observacoes; 
    }

    public function comDataDeEmissao($dataDeEmissao = null)
    {
        $this->dataDeEmissao = $dataDeEmissao ?? date('Y-m-d h:i:s');
    }

    public function adicionaItem(ItemDaNota $itemDaNota) 
    {
        $this->itensDaNota[] = $itemDaNota; 
    }

    private function calculaValorBruto()
    {
        foreach($this->itensDaNota as $item) {
            $this->valorBruto += $item->getValor(); 
        }
    }

    public function adicionaAcao(Acao $acao)
    {
        $this->acoesDaNota[] = $acao;
    }

    public function gerar()
    {
        $this->calculaValorBruto();

        $notaFiscal = new NotaFiscal(
            $this->razaoSocial,
            $this->cnpj,
            $this->valorBruto,
            $this->dataDeEmissao,
            $this->observacoes
        );

        // executar algumas funcionalidades assim que uma nota for gerada
        foreach ($this->acoesDaNota as $acao) {
            $acao->executa($notaFiscal);
        }

        return $notaFiscal;
    }

    private function imprimeNota(NotaFiscal $nf)
    {
        echo 'Imprimi a nota fiscal! <br><br>';
    }

    private function salvaNoBanco(NotaFiscal $nf)
    {
        echo 'Salvei os dados da nota no banco! <br><br>';
    }

    private function enviaEmail(NotaFiscal $nf)
    {
        echo 'Enviei o e-mail com as informações da nota! <br><br>';
    }
}