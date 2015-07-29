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

//Acesso direto n�o � permitido
if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

class ZeraDownloads{

	private $con;
	private $res;
	private $Banco;
	private $arquivo;
	private $nome_arquivo;

	private function ZeraDown(){
		if (!file_exists($this->nome_arquivo)){
			
			$this->con = "UPDATE `arquivos` SET `hits` = '0';";
			$this->res = mysql_query($this->con,$this->Banco->condb);
			$this->CriaTemp();
		}
	}
	
	private function CriaTemp(){
		$this->arquivo = fopen ($this->nome_arquivo, "w");
		fclose($this->arquivo);
	}

	private function DelTemp(){
		if (file_exists($this->nome_arquivo)){
			unlink($this->nome_arquivo);
		}
	}



	function __construct(){
	
		$this->nome_arquivo = loadconfig('caminho_arquivos')."/dont_remove";
		$this->Banco = new Banco;
		

		if(date(d) == "01"){			
			$this->ZeraDown();
		}
		else{
			$this->DelTemp();
		}


	}

}

$ZeraDownloads = new ZeraDownloads;
?>
