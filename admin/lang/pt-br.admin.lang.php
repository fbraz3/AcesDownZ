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

//Menu
$lang_acp['menu_inserir'] 			= "Inserir Arquivo";
$lang_acp['menu_operacoes'] 		= "Operacoes de Arquivos";
$lang_acp['menu_logs'] 				= "Logs de Downloads";
$lang_acp['menu_erros'] 			= "Logs de Erros";
$lang_acp['nao_encontrado'] 		= "Página Não Encontrada!!";
$lang_acp['nao_instalado'] 			= "Sistema nao instalado, por favor execute o instalador primeiro!";

//Sem permissão de escrita
$lang_acp['dir_not_write']      	= 'Seu diretorio de downloads nao possui permisao de escrita.<br>';
$lang_acp['dir_not_write']      	.= 'Corrija as permissoes, e acesse o admin novamente.';
$lang_acp['dir_not_write']      	.= '<br><br>';
$lang_acp['dir_not_write']      	.= 'Em caso de duvidas para aplicar a permissao, consulte seu provedor';


//Inserir Arquivos
$lang_acp['titulo_tabela']			= 'Envio de Arquivos';
$lang_acp['titulo_registro']		= 'Apenas registrar arquivo no Banco';
$lang_acp['titulo_limite']			= 'Limite:';
$lang_acp['arq_movido']				= 'Arquivo enviado com exito';
$lang_acp['arq_registrado']			= 'Arquivo registrado com exito';
$lang_acp['sem_arquivo']			= 'Nenhum arquivo especificado';
$lang_acp['arquivo_existe']			= 'ERRO: Arquivo já registrado no banco';
$lang_acp['arquivo_n_existe_ftp']	= 'ERRO: Arquivo nao existe no FTP';


//Logs e Erros
$lang_acp['tbl_arq']				= 'Arquivo';
$lang_acp['tbl_data']				= 'Data';
$lang_acp['tbl_hora']				= 'Hora';
$lang_acp['tbl_browser']			= 'Browser';
$lang_acp['tbl_sistema']			= 'SO';
$lang_acp['tbl_ip']					= 'IP';
$lang_acp['tbl_reverso']			= 'Reverso';
$lang_acp['tbl_user']				= 'Usuario';
$lang_acp['tbl_posts']				= 'Posts';
$lang_acp['tbl_referer']			= 'Referer';
$lang_acp['tbl_motivo']				= 'Motivo';
$lang_acp['total_reg']				= 'Total de Registros:';
$lang_acp['paginas']				= 'Paginação:';

//Operações
$lang_acp['link_download']			='Link Download';
$lang_acp['total_arq']				= 'Total de Arquivos:';
$lang_acp['total_down']				= 'Total de Downloads:';
$lang_acp['down_mes']				= 'Downloads este Mes:';
$lang_acp['total_falhas']			= 'Total de Falhas:';
$lang_acp['nome_arq']				= 'Nome do Arquivo';
$lang_acp['hits']					= 'Hits';
$lang_acp['limite']					= 'Limite';
$lang_acp['inserido']				= 'Inserido Em';
$lang_acp['del_arq']				= 'Deletar Arquivo';
$lang_acp['apag_log']				= 'Apagar Logs:';
$lang_acp['apag_arq']               = 'Apagar Arquivo:';
$lang_acp['arq_atualizado']         = 'Arquivo Atualizado';
$lang_acp['apag_tbl']               = 'Apagado da tabela';
$lang_acp['apag_arq_ok']            = 'Arquivo Apagado';
$lang_acp['apag_arq_fail']          = 'Falha ao apagar Arquivo';
$lang_acp['date']                   = 'Data';
$lang_acp['hour']                   = 'Hora:';
$lang_acp['confirma_exlcusao']		= 'Confirme exclusão do arquivo';
$lang_acp['nao_arq_reg']			= 'Nenhum arquivo registrado ainda';



?>
