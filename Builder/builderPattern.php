<?php

/**
 * O builder pattern é usado para a criação de objetos complexos, quando há
 * muitos atributos para serem inicializados ou que dependem de operações para
 * serem valorados.
 * 
 * Nesse caso é criada uma classe "Builder" onde pode inicializar e calcular os
 * atributos da classe principal através de metodos separados, e, finalmente 
 * retornar uma instância pronta.
 * 
 * ------------------
 * 
 * No exemplo abaixo, ao invés de passar todos os atributos no contrutor, 
 * e ter que calcular seu total e setar data padrão de emissão, ex:
 * `new NotaFiscal( $this->razaoSocial, $this->cnpj, $this->valorBruto, $this->dataDeEmisao, $this->observacoes)`
 *
 * ...é criado um builder, onde cada atributo é passado por um método, e o valor
 * bruto e a data são calculados, retornando a instância de NotaFiscal.
 */

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

class NotaFiscalBuilder
{
    private $razaoSocial;
    private $cnpj;
    private $dataDeEmissao;
    private $itensDaNota = [];
    private $valorBruto = 0;
    private $observacoes;

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

        return $notaFiscal;
    }
}

$item1 = new ItemDaNota('Camiseta', 50.25);
$item2 = new ItemDaNota('Calça', 70);
$item3 = new ItemDaNota('Tênis', 180);

$notaFiscal = new NotaFiscalBuilder();

$notaFiscal->comRazaoSocial('Razão Social de Teste');
$notaFiscal->comCnpj('44.746.515/0001-00');
$notaFiscal->comObservacoes('Essas são as observações da nota fiscal');
$notaFiscal->comDataDeEmissao(); // omitindo, usará a data atual

$notaFiscal->adicionaItem($item1);
$notaFiscal->adicionaItem($item2);
$notaFiscal->adicionaItem($item3);

$notaFiscalGerada = $notaFiscal->gerar();

echo '<pre>';

echo '<h3> Itens da nota </h3>';
var_dump($item1, $item2, $item3);

echo '<h1> Instância gerada </h1>';
var_dump($notaFiscalGerada);
