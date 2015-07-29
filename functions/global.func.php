<?php

//Acesso direto não é permitido
if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

//Funções dioversas pra imprimir mensagens nas classes, valeu totoro!


//Função pra retornar o valor da classe de configuraï¿½ï¿½o
function loadconfig($string_config){
	global $CONFIG;
	return $CONFIG[$string_config];
}

//Função pra retornar srting do array de linguagem
function print_msg($string_msg){
		global $lang;
		return $lang["$string_msg"];
}

?>
