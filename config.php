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

if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

//Database connection
$CONFIG['hostdb'] = "mysql.yourdomain.com";
$CONFIG['userdb'] = "yourdomain";
$CONFIG['passdb'] = "yourpass";
$CONFIG['nomebd'] = "yourdomain";

//Nome do Arquivo de Download
$CONFIG['download_file'] = "download.php";

//Nome da pasta de administração
$CONFIG['admin_dir'] = "admin";

//Define Language
$CONFIG['language'] = "pt-br";

//Quantidade de downloads diarios por IP
//Deixe como "0" para desabilitar;
$CONFIG['limite_ip'] = "2";

//Download esta como modulo do invision ou nenhum?
//Choices: "invision" or "none"
$CONFIG['forum'] = "none";

//Quantidade de downloads diarios por usuarios do forum
//Deixe como "0" para desabilitar;
$CONFIG['limite_user'] = "2";

//Qual o n�mero minimo de posts para baixar arquivos? "0" desabilita.
$CONFIG['minimo_posts'] = "0";

//Caminho dos arquivos, pode ser relativo
$CONFIG['caminho_arquivos'] = "uploads/";

//Caminho fisico de nstalacao de seu forum (Caso utilize esta funcao)
$CONFIG['caminho_forum'] = "/users/yourdomain/public_html";

//Numero de registros por pagina nos logs de erros e de downloads
$CONFIG['num_pag'] = "20";

?>
