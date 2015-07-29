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

define("IN_ADZ",True);

require_once('config.php');
require_once ('functions/global.func.php');
require_once('lang/'.loadconfig("language").'.lang.php');
require_once('classes/banco.class.php');

if(file_exists(loadconfig('caminho_arquivos')."/installed.php")){
	echo "<center>".print_msg('ja_instalado')."</center>";
	die();
}

if(!is_writable(loadconfig('caminho_arquivos'))){
	echo "<center>".print_msg('dir_not_write')."</center>";
	die();
}

$banco = new Banco;
	
$sql = "
CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` int(50) NOT NULL auto_increment,
  `arquivo` varchar(100) NOT NULL default '',
  `hits` int(11) default NULL,
  `limite` decimal(10,0) default NULL,
  `tamanho` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  `inseridoDT` date default NULL,
  `inseridoHR` varchar(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;";

if(mysql_query($sql,$banco->condb)){ 
	echo print_msg('db_install_ok')." 'Arquivos'<br>";
} else{ echo print_msg('db_install_error')." 'Arquivos'<br>"; }

$sql = "CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(11) NOT NULL auto_increment,
  `arquivo` varchar(50) default NULL,
  `dia` date default NULL,
  `hora` time default NULL,
  `user` varchar(50) default NULL,
  `posts` varchar(50) default NULL,
  `browser` varchar(50) default NULL,
  `so` varchar(50) default NULL,
  `ip` varchar(50) NOT NULL default '',
  `reverso` varchar(50) default NULL,
  `referer` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2729 ;";

if(mysql_query($sql,$banco->condb)){ 
	echo print_msg('db_install_ok')." 'Downloads'<br>";
} else{ echo print_msg('db_install_error')." 'Downloads'<br>"; }

$sql = "CREATE TABLE IF NOT EXISTS `falhas` (
  `id` int(11) NOT NULL auto_increment,
  `arquivo` varchar(50) default NULL,
  `dia` date default NULL,
  `hora` time default NULL,
  `user` varchar(50) default NULL,
  `posts` varchar(50) default NULL,
  `browser` varchar(50) default NULL,
  `so` varchar(50) default NULL,
  `ip` varchar(50) NOT NULL default '',
  `reverso` varchar(50) default NULL,
  `referer` text NOT NULL,
  `motivo` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2801 ;";

if(mysql_query($sql,$banco->condb)){ 
	echo print_msg('db_install_ok')." 'Falhas'<br>";
} else{ echo print_msg('db_install_error')." 'Falhas'<br>"; }

//Abre arquivo pra edicao
$arquivo = fopen (loadconfig('caminho_arquivos')."/installed.php", "w");

//Monta copyleft
$cont = "<? \n";
$cont .= "  /* \n";
$cont .= "  *  Aces Downz is a Download Manager and Bandwidth Control \n";
$cont .= "  *  Copyright (C) 2009 Felipe Braz <fbraz3@gmail.com> \n";
$cont .= "  * \n";
$cont .= "  *  This file is part of Aces Downz. \n";
$cont .= "  * \n";
$cont .= "  *  Aces Downz is free software: you can redistribute it and/or modify \n";
$cont .= "  *  it under the terms of the GNU General Public License as published by \n";
$cont .= "  *  the Free Software Foundation, either version 3 of the License, or \n";
$cont .= "  *  (at your option) any later version. \n";
$cont .= "  * \n";
$cont .= "  *  Aces Downz is distributed in the hope that it will be useful, \n";
$cont .= "  *  but WITHOUT ANY WARRANTY; without even the implied warranty of \n";
$cont .= "  *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the \n";
$cont .= "  *  GNU General Public License for more details. \n";
$cont .= "  * \n";
$cont .= "  *  You should have received a copy of the GNU General Public License \n";
$cont .= "  *  along with Foobar.  If not, see <http://www.gnu.org/licenses/>. \n";
$cont .= "  */ \n";
$cont .= " \n";
$cont .= " \n";
$cont .= "if (!defined('IN_ADZ')){ die(\"<b>Direct Access not allowed</b>\"); }\n";
$cont .= "?>";


//Escreve e fecha o arquivo
fwrite($arquivo, $cont);
fclose($arquivo);

chmod (loadconfig('caminho_arquivos')."/installed.php", 0400);

$banco->FechaConexao;
?>
