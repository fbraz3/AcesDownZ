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

//Classe pra conectar no banco
class Banco{

	public $condb;	
	
	//Classe que conecta ao banco e seleciona o banco
	private function ConectaBanco(){		
		$this->condb =	mysql_connect(loadconfig('hostdb'),loadconfig('userdb'),loadconfig('passdb')) or DIE(print_msg('nao_conectou_na_base') ."<br>" . mysql_error());
		mysql_select_db(loadconfig('nomebd')) or die(print_msg('database_nao_encontrada')."<br>" . mysql_error());			
	}
	
	//Limpando resíduos
	public function FechaConexao(){
		@mysql_close($this->condb);
	}
	
	//Construtor
	public function __construct(){
		$this->ConectaBanco();		
	}	
}	


?>
