<?php

require_once('Imposto.php');
require_once('CalculadoraDeImpostos.php');
require_once('Orcamento.php');
require_once('ICMS.php');
require_once('IPVA.php');
require_once('ISS.php');

$orcamento = new Orcamento(1000);

$calculadora = new CalculadoraDeImpostos();

/* Ao invés de fazer vários ifs dentro da calculadora de impostos para saber
* qual imposto aplicar, ex:
* 
* if ($imposto == 'ICMS') { ... } else if ($imposto == 'IPVA') { ... } else ...
* 
* ...são calculados os impostos a partir de um único método calcula(), que varia
* sua implementação de acordo com a classe usada, baseando-se em uma interface.
* 
* O pattern Strategy é efetivo quando há muitos ifs e regras acopladas, permitindo
* isolar regras e evitar crescimento desenfreado de classes
* 
* */

echo 'ICMS: ' . $calculadora->calcula($orcamento, new ICMS) . '<br>';

echo 'IPVA: ' . $calculadora->calcula($orcamento, new IPVA) . '<br>';

echo 'ISS: ' . $calculadora->calcula($orcamento, new ISS) . '<br>';
