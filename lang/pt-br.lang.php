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

//Acesso direto nï¿½o ï¿½ permitido
if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

//Language Array
$lang['nao_conectou_na_base'] 		= "Nao foi possivel conectar na base de dados";
$lang['database_nao_encontrada'] 	= "Banco de dados nao foi encontrado!";
$lang['sem_arquivo_get'] 			= 'Nenhum Arquivo Selecionado';
$lang['arquivo_nao_existe'] 		= 'Arquivo solicitado nao encontrado';
$lang['downloads_excedidos'] 		= 'Quota de downloads mensais excedidas para este arquivo';
$lang['usuario_nao_logado']             = 'Você deve estar logado no forum para baixar o arquivo';
$lang['sem_quantidade_posts'] 		= 'Sem quantidade de posts para baixar este arquivo';
$lang['limite_downloads_user'] 		= 'Seu usuario ja baixou muitas vezes este arquivo hoje, tente amanha';
$lang['limite_downloads_ip'] 		= 'Seu IP ja baixou muitas vezes este arquivo hoje, tente amanha';
$lang['db_err_limit']				= 'Excedeu Limite';
$lang['db_err_ip']					= 'Limite IP';
$lang['db_err_user']				= 'Limite User';
$lang['db_err_post']				= 'Quantidade Posts';
$lang['db_err_arq']					= 'Arquivo inexistente';
$lang['db_err_login']                   = 'Nao Logado';
	
//Install
$lang['db_install_ok']              = 'Tabela instalada:';
$lang['db_install_error']           = 'Tabela nao Instalada:';
$lang['ja_instalado']               = 'Sistema ja instalado!';
$lang['dir_not_write']				= 'Seu diretorio de downloads nao possui permisao de escrita.<br>';
$lang['dir_not_write']				.= 'Por causa deste erro, a instalacao nao pode continuar!<br>';
$lang['dir_not_write']              .= 'Corrija as permissoes, e execute o script novamente.';
$lang['dir_not_write']              .= '<br>';
$lang['dir_not_write']				.= 'Em caso de duvidas para aplicar a permissao, consulte seu provedor';

?>
