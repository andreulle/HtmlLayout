<?php
include "HtmlLayout.class.php";

//Inclusão de outras páginas PHP
include "include_example.php";

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

//Momento onde incluímos a página pho no parametro marcado no html
$layout->includes("include", $inc_layout->getLayout());

$layout->htmlIncludes("footer", "footer_html.html");

echo $layout->getLayout();
?>