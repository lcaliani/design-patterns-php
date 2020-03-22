# Design Pattern aplicados à PHP

Estudos com exemplos de Design Patterns aplicados à linguagem PHP

### [Strategy](https://github.com/lcaliani/design-patterns-php/blob/master/Strategy/index.php)
Útil para: 
  * Evitar crescimento desenfreado de classes
  * Evitar uso de muitas condicionais (ifs)
  * Isolar regras em classes

### [Observer](https://github.com/lcaliani/design-patterns-php/blob/master/Observer/observerPattern.php)
Útil para:
  * Quando várias ações devem ser tomadas a partir de um acontecimento específico no código, exemplos:
  > Após gravar no banco, fazer x coisas; Após certo usuário fazer x ação, fazer y coisas; etc

### [Template Method](https://github.com/lcaliani/design-patterns-php/blob/master/Template_Method/template-method-ICPP-IKCV.php)
Útil para:
  * Quando um conjunto de classes tem alguns métodos com implementação idêntica e outros que podem variar de acordo com a classe expecífica
  * Evitar duplicação de método idênticos

### [Builder](https://github.com/lcaliani/design-patterns-php/blob/master/Builder/builderPattern.php)
Útil para
  * Facilitar criação de instâncias de classes com uma quantidade média/elevada de atributos
