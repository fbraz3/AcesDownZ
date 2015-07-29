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

$banco = new Banco;

// Mostra qtidade de registros.
$consdown = "SELECT COUNT(*) FROM falhas";			
$consarq = mysql_query($consdown,$banco->condb);
$total_reg = mysql_result($consarq, 0);

//Paginação
$tamanho_pag = loadconfig('num_pag');
$pagina = $_GET["pag"];

if (!$pagina) {
   $inicio = 0;
   $pagina=1;
}
else{
   $inicio = ($pagina - 1) * $tamanho_pag;
} 

$total_paginas = ceil($total_reg / $tamanho_pag); 

//Variáveis
$consulta = "SELECT * FROM falhas ORDER BY id DESC LIMIT ".$inicio.",".$tamanho_pag."";			
$res = mysql_query($consulta,$banco->condb);
$mostra=mysql_fetch_array($res);

?>
<style type="text/css">
<!--
.pagina {
	color: #F00;
}
-->
</style>

<b><?=print_msg_acp('total_reg') ?></b> <? echo $total_reg; ?><br><br>
<table width="100%" style = "border-style: solid; border-width: 1"  >
  <tr>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_arq') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_data') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_hora') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" "><strong><?=print_msg_acp('tbl_browser') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_sistema') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_ip') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_reverso') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_referer') ?></strong></td>
    <? if (loadconfig('forum') != "none"){ ?>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_user') ?></strong></td>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_posts') ?></strong></td>
    <? } ?>
    <td align="center" bgcolor="#999999" style = "border-style: solid; border-width: 1" ><strong><?=print_msg_acp('tbl_motivo') ?></strong></td>
  </tr> 
  <?
  	$data = $mostra[dia];
	$data = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,0,4);  
  ?>  
  <tr>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['arquivo'] == ""){ echo "&nbsp;"; } else{ echo $mostra['arquivo']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?=$data;?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['hora'] == ""){ echo "&nbsp;"; } else{ echo $mostra['hora']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['browser'] == ""){ echo "&nbsp;"; } else{ echo $mostra['browser']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['so'] == ""){ echo "&nbsp;"; } else{ echo $mostra['so']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['ip'] == ""){ echo "&nbsp;"; } else{ echo $mostra['ip']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['reverso'] == ""){ echo "&nbsp;"; } else{ echo $mostra['reverso']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['referer'] == ""){ echo "&nbsp;"; } else{ echo $mostra['referer']; }?></td>
    <? if (loadconfig('forum') != "none"){ ?>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['user'] == ""){ echo "&nbsp;"; } else{ echo $mostra['user']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['posts'] == ""){ echo "&nbsp;"; } else{ echo $mostra['posts']; }?></td>
    <? } ?>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['motivo'] == ""){ echo "&nbsp;"; } else{ echo $mostra['motivo']; }?></td>
  </tr>
  <? while ($mostra=mysql_fetch_array($res)){
   	$data = $mostra[dia];
	$data = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,0,4);  
  ?>
  <tr>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['arquivo'] == ""){ echo "&nbsp;"; } else{ echo $mostra['arquivo']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?=$data;?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['hora'] == ""){ echo "&nbsp;"; } else{ echo $mostra['hora']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['browser'] == ""){ echo "&nbsp;"; } else{ echo $mostra['browser']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['so'] == ""){ echo "&nbsp;"; } else{ echo $mostra['so']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['ip'] == ""){ echo "&nbsp;"; } else{ echo $mostra['ip']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['reverso'] == ""){ echo "&nbsp;"; } else{ echo $mostra['reverso']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['referer'] == ""){ echo "&nbsp;"; } else{ echo $mostra['referer']; }?></td>
    <? if (loadconfig('forum') != "none"){ ?>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['user'] == ""){ echo "&nbsp;"; } else{ echo $mostra['user']; }?></td>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['posts'] == ""){ echo "&nbsp;"; } else{ echo $mostra['posts']; }?></td>
    <? } ?>
    <td style = "border-style: solid; border-width: 1" ><?if($mostra['motivo'] == ""){ echo "&nbsp;"; } else{ echo $mostra['motivo']; }?></td>
  </tr>
  <? } ?>
</table>
<? if ($total_paginas > 1){ ?>
<p align="center"><strong class="pagina"><?=print_msg_acp('paginas') ?></strong><br />

<?
   for ($i=1;$i<=$total_paginas;$i++){
      if ($pagina == $i)
         //se mostro o índice da página actual, não coloco link
         echo " <b>". $pagina . "</b> ";
      else
         //se o índice não corresponde com a página mostrada actualmente, coloco o link para ir a essa página
         echo " <a href='index.php?act=erros&pag=" . $i . "'>" . $i . "</a> ";
   }
} 
?>
</p>
<? $banco->FechaConexao(); ?>
