<?php

/**
 * O padrão Observer é util quando alguma ação deve ser tomada quando algum
 * "evento" é disparado, separando por classes as implementações e, no momento
 * da chamada, utilizar uma interface.
 *
 * Ele permite que diversas ações sejam executadas de forma transparente à
 * classe principal, reduzindo o acoplamento entre essas ações, facilitando a
 * manutenção e evolução do código sem impactar funcionalidades já implementadas.
 * ------------------
 * 
 * No exemplo abaixo, ao gerar a nota `(NotaFiscalBuilder@gerar)` deve-se
 * imprimí-la, salvá-la no banco de dados e enviar um e-mail.
 * 
 * Para cada ação foi criada uma classe específica com um único método `executar()`,
 * "assinado" a partir da interface `Acao`, onde cada classe que usa-o
 * tem sua implementação específica
 *
 * A partir disso, é chamado o método `adicionaAcao()` de `NotaFiscalBuilder`,
 * passando a instância de cada classe de ação.
 * 
 * Por fim, é feito um loop(NotaFiscalBuilder:64), chamando o método `executa()`
 * para cada instância informada.
 * 
 * Dessa forma todas as ações são executadas isoladamente e facilita a adição de
 * novas, sendo necessário somente criar uma classe que implemente a interface `Acao`
 * e passando-a no método `adicionaAcao()`
 * 
 * ------------------
 * 
 * Outra forma seria ajustar para que o construtor de `NotaFiscalBuilder` recebesse
 * um array de ações (interface Acao), dessa maneira o método `adicionaAcao()`
 * não seria mais necessário.
 */

require_once('AcoesDaNota/Acao.php');
require_once('AcoesDaNota/Impressora.php');
require_once('AcoesDaNota/BancoDeDados.php');
require_once('AcoesDaNota/Email.php');

require_once('ItemDaNota.php');
require_once('NotaFiscal.php');
require_once('NotaFiscalBuilder.php');

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

$notaFiscal->adicionaAcao(new BancoDeDados);
$notaFiscal->adicionaAcao(new Impressora);
$notaFiscal->adicionaAcao(new Email);

$notaFiscalGerada = $notaFiscal->gerar();

echo '<pre>';

echo '<h3> Itens da nota </h3>';
var_dump($item1, $item2, $item3);

echo '<h1> Instância gerada </h1>';
var_dump($notaFiscalGerada);
