<?php

  /*
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
  */

//Acesso direto não é permitido
if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

$dt = date(y)."-".date(m)."-".date(d);
$hr = date(G).":".date(i).":".date(s);

//Se o botao "enviar" foi apertado
if(isset($_POST['envia_arquivo'])){

	if($_FILES['f']['name'] == ""){
		echo JSAlert(print_msg_acp('sem_arquivo'));
	}
	else{
	require_once "../pear/HTTP/Upload.php";

	$upload = new HTTP_Upload("en");
	$file = $upload->getFiles("f");

	if ($file->isValid()) {
		$banco = new Banco;
		//Verifica se arquivo ja existe no banco
		$sql = 'SELECT COUNT(*) FROM `arquivos` WHERE `arquivo` = \''.$file->getprop('name').'\'';
		$res = mysql_query($sql,$banco->condb);
		if(mysql_result($res, 0) >= "1"){
			echo JSAlert(print_msg_acp('arquivo_existe').": ".$file->getprop('name'));			
		}
		else{		
				$moved = $file->moveTo('../'.loadconfig('caminho_arquivos'));   	
				$sql = 'INSERT INTO `arquivos` (`arquivo`, `hits`, `limite`, `tamanho`, `mime`, `inseridoDT`, `inseridoHR`) VALUES (\''.$file->getprop('name').'\', \''.$_POST['hits'].'\', \''.$_POST['limite'].'\', \''.$file->getprop('size').'\', \''.$file->getprop('type').'\', \''.$dt.'\', \''.$hr.'\');';
				mysql_query($sql,$banco->condb);
				
				if (!PEAR::isError($moved)) {
					echo JSAlert(print_msg_acp('arq_movido').": ".$file->getprop('name'));
				} else {
					echo JSAlert($moved->getMessage());
				} 
				if ($file->isMissing()) {
				//echo JSAlert(print_msg_acp('sem_arquivo'));
				echo print_msg_acp('sem_arquivo');
				}
			}
			$banco->FechaConexao();
		}	
	}
}

//Registra Arquivo
if(isset($_POST['registra_arquivo'])){
	
		if($_POST['f2'] == ""){
			echo JSAlert(print_msg_acp('sem_arquivo'));
		}
		elseif(@!file_exists('../'.loadconfig('caminho_arquivos').$_POST['f2'])){
			echo JSAlert(print_msg_acp('arquivo_n_existe_ftp').": ".$_POST['f2']);
		}
		else{
			$banco = new Banco;
			$sql = 'INSERT INTO `arquivos` (`arquivo`, `hits`, `limite`, `tamanho`, `mime`, `inseridoDT`, `inseridoHR`) VALUES (\''.$_POST['f2'].'\', \''.$_POST['hits'].'\', \''.$_POST['limite'].'\', \''.filesize('../'.loadconfig('caminho_arquivos')."/".$_POST['f2']).'\', \'application/octet-stream\', \''.$dt.'\', \''.$hr.'\');';
	    	if (mysql_query($sql,$banco->condb)){
				echo JSALERT(print_msg_acp('arq_registrado'));
			}
		}		
}
?>  
<form name="upload" method="post" enctype="multipart/form-data"
   action="<? $PHP_SELF; ?>">
    
<div align="center">
      <table width="520" border="1">
        <tr>
          <td colspan="3" align="center"><strong><?=print_msg_acp('titulo_tabela')?></strong></td>
        </tr>
        <tr>
          <td width="226" align="center"><input type="file" name="f" /></td>
          <td width="126" align="center"><?=print_msg_acp('titulo_limite')?>
            <input type="hidden" name="hits" value="0" size="3">          <input type="text" name="limite" value="0" size="3"></td>
          <td width="146" align="center"><input type="submit" name="envia_arquivo" value="Enviar" /></td>
        </tr>
      </table>
    </div>
  </form>
  <br>
  <div align="center">
    <form name="upload2" method="post" enctype="multipart/form-data"
   action="<? $PHP_SELF; ?>">
    <table width="520" border="1">
      <tr>
        <td colspan="3" align="center"><strong>
          <?=print_msg_acp('titulo_registro')?>
        </strong></td>
      </tr>
      <tr>
        <td width="226" align="center"><input type="text" name="f2" size="30" /></td>
        <td width="126" align="center"><?=print_msg_acp('titulo_limite')?>
          <input type="hidden" name="hits" value="0" size="3">
          <input type="text" name="limite" value="0" size="3"></td>
        <td width="146" align="center"><input type="submit" name="registra_arquivo" value="Enviar" /></td>
      </tr>
    </table>
    </form>
  </div>
 </body>

</html>
