<?
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
?>

<script language="JavaScript"> 
function confirma(){ 
   if (confirm('<?=print_msg_acp('confirma_exlcusao')?>')){ 
      document.deletar.submit() 
      return true;
   }
  else{
     return false;
  }
} 
</script>

<body>

<div align="center">
<?

//Cria o link do download
$URL = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
preg_match_all('/(.*)\/'.loadconfig('admin_dir').'(.*)?/s', $URL, $URL);
$URL = "http://".$URL[1][0]."/".loadconfig('download_file')."?file=";

$banco = new Banco;

//Atualizar Registro
if(isset($_POST['Atualizar'])){
	$arq=$_POST["arquivo"];
	$num=$_POST["limite"];
	$id=$_POST["id"];
	
	$consulta = "UPDATE arquivos SET limite='$num' WHERE id='$id';";
	mysql_query($consulta,$banco->condb);
	echo JSAlert(print_msg_acp('arq_atualizado').": ".$arq);
}

//Deletar Registro
if(isset($_POST['Deletar'])){
	$arq=$_POST["arquivo"];
	
	$consulta = "DELETE FROM arquivos WHERE id='$id'";
	mysql_query($consulta,$banco->condb);
	$popup .=  print_msg_acp('apag_tbl')." Arquivos\\n";
	
	if(isset($_POST['del_logs'])){
		$consulta = "DELETE FROM downloads WHERE arquivo='$arq'";
		mysql_query($consulta,$banco->condb);
		$popup .= print_msg_acp('apag_tbl')." Downloads\\n";
		
		$consulta = "DELETE FROM falhas WHERE arquivo='$arq'";
		mysql_query($consulta,$banco->condb);
		$popup .= print_msg_acp('apag_tbl')." Falhas\\n";
		
	}
	if(isset($_POST['del_arq'])){
	 	if(@unlink('../'.loadconfig('caminho_arquivos')."/".$arq)){
                	$popup .= print_msg_acp('apag_arq_ok').": ".$arq."\\n";
         	}
         	else{
         	       $popup .= print_msg_acp('apag_arq_fail').": ".$arq."\\n";
         	}
	}
	echo JSAlert($popup);
	
}

//Paginação
//================================================
$tamanho_pag = loadconfig('num_pag');
$pagina = $_GET["pag"];

if (!$pagina) {
   $inicio = 0;
   $pagina=1;
}
else{
   $inicio = ($pagina - 1) * $tamanho_pag;
} 
//================================================

//Consulta para montar a tabela Geral
$consulta = "SELECT * FROM arquivos ORDER BY id LIMIT ".$inicio.",".$tamanho_pag.";";			
$res_main = mysql_query($consulta,$banco->condb);
$mostra=mysql_fetch_array($res_main);
?>

  <table width="500" border="1">
    <tr>
      <td width="166" align="center">
      <?	$consulta = "SELECT COUNT(*) FROM arquivos";			
	  $res = mysql_query($consulta,$banco->condb);?>
      <b><?=print_msg_acp('total_arq')?></b></td>
      <td width="47" align="center"><?=$total_reg = mysql_result($res, 0);?></td>
    </tr>
    <tr>
      <td align="center"><? $consulta = "SELECT COUNT(*) FROM downloads";			
$res = mysql_query($consulta,$banco->condb); ?>
      <b><?=print_msg_acp('total_down')?></b></td>
      <td align="center"><?=mysql_result($res, 0);?></td>
    </tr>
    <tr>
      <td align="center"><? $consulta = "SELECT SUM(hits) FROM arquivos";			
$res = mysql_query($consulta,$banco->condb); ?>
      <b><?=print_msg_acp('down_mes')?></b></td>
      <td align="center"><? $down_mes = mysql_result($res, 0);  if ($down_mes == ""){ echo "0"; } else { echo mysql_result($res, 0); }?></td>
    </tr>
    <tr>
      <td align="center"><? $consulta = "SELECT COUNT(*) FROM falhas";			
$res = mysql_query($consulta,$banco->condb); ?>
      <b><?=print_msg_acp('total_falhas')?></b></td>
      <td align="center"><?=mysql_result($res, 0);?></td>
    </tr>
  </table>
  
  <?
  //Evitando quebra de layout	
  if ($total_reg == 0){
	echo "<br><br><center><b>".print_msg_acp('nao_arq_reg')."</center></b>";
	$banco->FechaConexao();
	die();	
  }
  ?>
  
  </p>
  <table width="95%" border="1">
    <tr>
      <th bgcolor="#CCCCCC" scope="col"><?=print_msg_acp('link_download')?></th>
      <th bgcolor="#CCCCCC" scope="col"><?=print_msg_acp('nome_arq')?></th>
      <th bgcolor="#CCCCCC" scope="col"><?=print_msg_acp('hits')?></th>
      <th bgcolor="#CCCCCC" scope="col"><?=print_msg_acp('inserido')?></th>
      <th bgcolor="#CCCCCC" scope="col"><?=print_msg_acp('limite')?></th>		
      <th bgcolor="#CCCCCC" scope="col"><?=print_msg_acp('del_arq')?></th>
    </tr>  
    
    <tr>
      <td width='180' td align='center' valign='middle'><label>
          <input type="text" name="link_arq" id="link_arq" value="<?=$URL.$mostra[arquivo]?>">
      </label></td>	
      <td width='203' td align='center' valign='middle'><?=$mostra[arquivo]?></td>
      <td width='50' td align='center' valign='middle'><?=$mostra[hits]?></td>
      <td width='90' td align='center' valign='middle'><?=$mostra[inseridoDT]."<br>".$mostra[inseridoHR]?></td>
      <td width='191' td align='center' valign='middle'>
        <form id='atualiar' name='atualizar' method='post' action='<? $PHP_SELF; ?>'><input name='limite' type='text' value='<?=$mostra[limite]?>' size='10' maxlength='5' /> =>
          
          <input name='arquivo' type='hidden' id='arquivo' value='<?=$mostra[arquivo]?>'><input name='id' type='hidden' id='id' value='<?=$mostra[id]?>'><input type='submit' name='Atualizar' value='Atualizar' id='Atualizar' />
        </form>
      </td>
      <td width='215' td align='center' valign='middle'><form id='deletar' name='deletar' method='post' action='<? $PHP_SELF; ?>' onSubmit="return confirma()">
        <label>
          <?=print_msg_acp('apag_log')?><input type="checkbox" name="del_logs" id="del_logs">
          <br>
          <?=print_msg_acp('apag_arq')?> 
          <input type="checkbox" name="del_arq" id="del_arq" checked="True">
<br>
<input name='arquivo' type='hidden' id='arquivo' value='<?=$mostra[arquivo]?>'><input name='id' type='hidden' id='id' value='<?=$mostra[id]?>'><input type='submit' name='Deletar' value='Deletar'" />
          </label>
        </form>
      </td>
      </tr>
    
  <?php while ($mostra=mysql_fetch_array($res_main)){ ?>
    <tr>
      <td width='180' td align='center' valign='middle'><input type="text" name="link_arq" id="link_arq" value="<?=$URL.$mostra[arquivo]?>"></td>
      <td width='203' td align='center' valign='middle'><?=$mostra[arquivo]?></td>
      <td width='50' td align='center' valign='middle'><?=$mostra[hits]?></td>
      <td width='90' td align='center' valign='middle'><?=$mostra[inseridoDT]."<br>".$mostra[inseridoHR]?></td>
      <td width='191' td align='center' valign='middle'>
        <form id='atualiar' name='atualizar' method='post' action='<? $PHP_SELF; ?>'><input name='limite' type='text' value='<?=$mostra[limite]?>' size='10' maxlength='5' /> =>
          <label for='Submit'></label>
          <input name='arquivo' type='hidden' id='arquivo' value='<?=$mostra[arquivo]?>'><input name='id' type='hidden' id='id' value='<?=$mostra[id]?>'><input type='submit' name='Atualizar' value='Atualizar' id='Atualizar' />
        </form>
      </td>
      <td width='215' td align='center' valign='middle'><form id='deletar' name='deletar' method='post' action='<? $PHP_SELF; ?>' onSubmit="return confirma()">
        <label>
          <?=print_msg_acp('apag_log')?><input type="checkbox" name="del_logs" id="del_logs">
          <br>
          <?=print_msg_acp('apag_arq')?>  
          <input type="checkbox" name="del_arq" id="del_arq" checked="True">
          <br>
<input name='arquivo' type='hidden' id='arquivo' value='<?=$mostra[arquivo]?>'><input name='id' type='hidden' id='id' value='<?=$mostra[id]?>'><input type='submit' name='Deletar' value='Deletar' />
          </label>
        </form>
      </td>
      </tr>
    
    <? } ?>
    </tr>
  </table>
</div>
<? 
//Monta Paginação
$total_paginas = ceil($total_reg / $tamanho_pag); 
if ($total_paginas > 1){ ?>
 
<p align="center"><strong class="pagina"><?=print_msg_acp('paginas') ?></strong><br />

<?
   for ($i=1;$i<=$total_paginas;$i++){
      if ($pagina == $i)
         //se mostro o índice da página actual, não coloco link
         echo " <b>". $pagina . "</b> ";
      else
         //se o índice não corresponde com a página mostrada actualmente, coloco o link para ir a essa página
         echo " <a href='index.php?act=oper&pag=" . $i . "'>" . $i . "</a> ";
   }
} 

?>


</form>
</body>
<?php
$banco->FechaConexao();
?>
</html>
