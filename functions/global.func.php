<?php

//Acesso direto n�o � permitido
if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

//Fun��es dioversas pra imprimir mensagens nas classes, valeu totoro!


//Fun��o pra retornar o valor da classe de configura��o
function loadconfig($string_config){
	global $CONFIG;
	return $CONFIG[$string_config];
}

//Fun��o pra retornar srting do array de linguagem
function print_msg($string_msg){
		global $lang;
		return $lang["$string_msg"];
}

?>
