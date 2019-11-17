<?php

/**
 * O pattern template method pode ser útil para quando classes que herdam métodos
 * mantenham o padrão, podendo ter alguns métodos concretos herdados do pai
 * e outros métodos abstratos implementados dentro delas.
 * 
 * Ele possibilita que o desenvolvedor escreva a "estrutura" do algoritmo apenas uma
 * vez, e a reutilize nas implementações específicas de cada um dos algoritmos.
 * 
 * -------------------
 * 
 * No exemplo abaixo, as classes `Icpp` e `Ikcv` herdam `Imposto`. 
 * 
 * As classes filhas utilizam somente a implementação do método `calculate()`,
 * enquanto os outros métodos `mustUseMaxTax()`, `minTax()` e `maxTax()` são
 * somente abstratos, tendo suas implementações específicas de acordo com a
 * necessidade de cada classe filha.
 */

class Orcamento {
    private $valor;

    private $itens = [];

    public function addItem(array $item) {
        $this->itens[] = $item;
    }

    public function getItens() {
        return $this->itens;
    }

    private function calculateValor() {
        if ($this->valor) {
            return;
        }

        foreach ($this->itens as $item) {
            $this->valor += $item['valor'];
        }
    }

    public function getValor() {
        $this->calculateValor();
        return $this->valor;
    }
}

/**
 * O imposto ICPP é calculado da seguinte forma: 
 * - caso o valor do orçamento seja menor que 500,00, deve-se cobrar 5%; 
 * caso contrário, 7%.
 */
class Icpp extends Imposto
{
    protected function mustUseMaxTax(Orcamento $orcamento) {
        return $orcamento->getValor() > 500;
    }

    protected function minTax(Orcamento $orcamento) {
        return $orcamento->getValor() * 0.05;
    }

    protected function maxTax(Orcamento $orcamento) {
        return $orcamento->getValor() * 0.07;
    }
}

/**
 * Já o imposto IKCV, 
 * - caso o valor do orçamento seja maior que 500,00 e algum 
 * item tiver valor superior a 100,00, o imposto a ser cobrado é de 10%; 
 * - caso contrário 6%.
 */
class Ikcv extends Imposto
{
    protected function mustUseMaxTax(Orcamento $orcamento) {
        $hasSuperiorValue = false;
        foreach ($orcamento->getItens() as $item) {
            if ($item['valor'] <= 100) {
                continue;
            }

            $hasSuperiorValue = true;
        }

        return $orcamento->getValor() > 500 && $hasSuperiorValue;
    }

    protected function minTax(Orcamento $orcamento) {
        return $orcamento->getValor() * 0.06;
    }

    protected function maxTax(Orcamento $orcamento) {
        return $orcamento->getValor() * 0.1;
    }
}

abstract class Imposto
{
    public function calculate(Orcamento $orcamento)
    {
        if ($this->mustUseMaxTax($orcamento)) {
            return $this->maxTax($orcamento);
        }

        return $this->minTax($orcamento);
    }

    abstract protected function mustUseMaxTax(Orcamento $orcamento);
    abstract protected function minTax(Orcamento $orcamento);
    abstract protected function maxTax(Orcamento $orcamento);
}

$orcamento = new Orcamento();
$orcamento->addItem(['nome' => 'bola', 'valor' => 51]);
$orcamento->addItem(['nome' => 'tenis', 'valor' => 450]);

echo 'valor do orçamento: R$ ' . $orcamento->getValor();
echo '<br><br>';

$icpp = new Icpp();
echo 'O valor do imposto ICPP é R$ ' . $icpp->calculate($orcamento);
echo '<br><br>';

$ikcv = new Ikcv();
echo 'O valor do imposto IKCV é R$ ' . $ikcv->calculate($orcamento);
echo '<br><br>';
