<?php
include "HtmlLayout.class.php";

$layout = new HtmlLayout("example.html");

//Troca o valor da pseudo variável html pelo valor desejado
$layout->changeValue("titulo", "Página de Exemplo");

//exemplo de Repeater no html
for($i=0;$i < 5;$i++){
	$layout->listItem("ListExample");
	$layout->changeValue("item",$i);
	$layout->changeValue("description","Descrição-".$i);
}

//Sempre que usar o listItem, é necessário usar um clear depois que sair do laço
$layout->cutText("ListExample");

//Altera todos as as pseudo variáveis de uma só vez
$layout->changeAllValue("itens", "O mesmo Valor");

$layout->useincludes("include", "include_example.html");

echo $layout->getLayout();
?>