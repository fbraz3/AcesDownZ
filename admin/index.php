<meta http-equiv="content-type" content="text/html; charset=utf-8" />

  <!--
  *  Aces Downz is a Download Manager and Bandwidth Control
  *  Copyright (C) 2009 Felipe Braz <fbraz3@gmail.com>
  *
  *  This file is part of Aces Downz.
  *
  *  Aces Downz is free software: you can redistribute it and/or modify
  *  it under the terms of the GNU General Public License as published by
  *  the Free Software Foundation, either version 3 of the License, or
  *  (at your option) any later version.
  *
  *  Aces Downz is distributed in the hope that it will be useful,
  *  but WITHOUT ANY WARRANTY; without even the implied warranty of
  *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  *  GNU General Public License for more details.
  *
  *  You should have received a copy of the GNU General Public License
  *  along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
  --!>


<?php

define("IN_ADZ",True);

require_once('../config.php');
require_once('../functions/global.func.php');
require_once('../lang/'.loadconfig("language").'.lang.php');
require_once('../classes/banco.class.php');

//Fncoes de Admin
require_once('functions/global.func.php');
require_once('lang/'.loadconfig("language").'.admin.lang.php');

if(!file_exists("../".loadconfig('caminho_arquivos')."/installed.php")){
	echo "<center>".print_msg_acp('nao_instalado')."</center>";
	die();
}
?>

<hr>
<div align="center">| <a href="index.php?act=inserir"><?=print_msg_acp('menu_inserir')?></a> | <a href="index.php?act=oper"><?=print_msg_acp('menu_operacoes')?></a> |  <a href="index.php?act=logs"><?=print_msg_acp('menu_logs')?></a> | <a href="index.php?act=erros"><?=print_msg_acp('menu_erros')?></a> | </div>
<hr>
<p><br>
<?
//Verifica se o diretorio de uploads tem permissão
if(!is_writable("../".loadconfig('caminho_arquivos'))){
	echo "<br><br><center><b>".print_msg_acp('dir_not_write')."</center></b>";
	die();
}

//Include no arquivo  
if (isset($_GET['act'])){	
  $arquivo = $_GET['act'].".php"; 
  if (file_exists($arquivo)){
	  require_once($arquivo);
  }
  else{
	echo '<p align="center">';
	echo print_msg_acp('nao_encontrado');
	echo '</p>';	
  }	  
}
else{
	require_once('oper.php');
}
?>
