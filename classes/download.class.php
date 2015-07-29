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

//Acesso direto n�o � permitido
if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

class Download {

	//Variaveis com dados
	private $referer;
	private $get_file; 
	private $ip;
	private $dt;
	private $hr;	
	
	//Outras Classes
	private $Banco;
	private $Forum;
	private $IPB;
	
	//Outras vari�veis	
	private $consulta_banco;	
	private $res;
	private $result;
	private $num_rows;
	private $mysql_array;
	private $hits;
	private $browser;
	private $platform;
	private $err_msg;
	
	//Mensagem e retorno
	public $msg;
	
	//Valida Arquivo de input
	private function Valida_GET(){
		if(@is_null($this->get_file)){ die(print_msg('sem_arquivo_get')); }		
	}
	
	//Valida se o arquivo existe
	private function Valida_Arquivo(){
		$this->consulta_banco = "SELECT arquivo,hits,limite FROM arquivos WHERE arquivo='".$this->get_file."'";
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);
		$this->num_rows = mysql_num_rows($this->res);
		
		if(!$this->num_rows == "0"){ return true; }
		else { return false; }
	}
	
	//Valida se o n�mero de hits j� nao esta esgotado
	private function Valida_Downloads(){
		$this->mysql_array = mysql_fetch_array($this->res);	
		if($this->mysql_array['hits'] >= $this->mysql_array['limite']){ return false; }
		else { return true; }
	}
	
	private function Valida_IP(){
		$this->consulta_banco = "SELECT COUNT(*) FROM downloads WHERE ip='".$this->ip."' AND dia='".$this->dt."'";
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);
		$this->result = mysql_result($this->res, 0);

		if ($this->result >= 2){ return false; }
		else { return true; }
	}
	
	private function Grava_Download (){
		//Consulta n�mero atual de downloads
		$this->consulta_banco = "SELECT arquivo,hits,limite FROM arquivos WHERE arquivo='".$this->get_file."'";
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);
		$this->result = mysql_fetch_array($this->res);
		$this->hits = ++$this->result[1];
		
		//Atualiza Registro
		$this->consulta_banco = "UPDATE arquivos SET hits=".$this->hits." WHERE arquivo='".$this->get_file."'";
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);

		//Loga o download
		$this->consulta_banco = 'INSERT INTO `downloads` (`ip`, `reverso`, `arquivo`, `dia`, `hora`, `referer`, `user`, `posts`, `browser`, `so`) VALUES (\''.$this->ip.'\', \''.gethostbyaddr($this->ip).'\', \''.$this->get_file.'\', \''.$this->dt.'\', \''.$this->hr.'\', \''.$this->referer.'\', \''.$this->IPB['name'].'\', \''.$this->IPB['posts'].'\', \''.$this->browser.'\', \''.$this->platform.'\');';
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);
		$this->Banco->FechaConexao();
	}
	
	//Loga no banco em caso de erro
	private function Grava_Erro($bco_msg){
		$this->consulta_banco = 'INSERT INTO `falhas` (`ip`, `reverso`, `arquivo`, `dia`, `hora`, `referer`, `user`, `posts`, `browser`, `so`, `motivo`) VALUES (\''.$this->ip.'\', \''.gethostbyaddr($this->ip).'\', \''.$this->get_file.'\', \''.$this->dt.'\', \''.$this->hr.'\', \''.$this->referer.'\', \''.$this->IPB['name'].'\', \''.$this->IPB['posts'].'\', \''.$this->browser.'\', \''.$this->platform.'\', \''.$bco_msg.'\');';		
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);
	}
	
	private function SendFile (){
		global $dl;
		
		$dl = new HTTP_Download();
  		$dl->setFile(loadconfig('caminho_arquivos').$this->get_file.'');
  		$dl->setContentDisposition(HTTP_DOWNLOAD_ATTACHMENT, ''.$this->get_file.'');
  		$dl->setContentType('application/octet-stream');
  		$dl->send(); 
	}
	
	//Inicia a Classe
	public function __construct(){

		$this->Banco = new Banco;
		$this->Navegador = new Navegador;

		//Seta as variaveis
		$this->referer = $_SERVER['HTTP_REFERER'];
		$this->get_file = $_GET['file'];
		$this->ip = $_SERVER["REMOTE_ADDR"];
		$this->dt = date(y)."-".date(m)."-".date(d);
		$this->hr = date(G).":".date(i).":".date(s);
		$this->consulta_banco = "aa";
		$this->browser = $this->Navegador->Name." ".$this->Navegador->Version;
		$this->platform = $this->Navegador->Platform;

		//Valida se tem GET
		$this->Valida_GET();
		
		//Carrega as funcoes do forum invision se tiver setado na config
		if(strtolower(loadconfig('forum')) == "invision"){
			global $ipsclass;		
			$this->IPB = $ipsclass->member;
			$this->Forum = new IPB_FORUM;			
		}

		//Validamos se o arquivo existe
		if (!$this->Valida_Arquivo()){
			$this->msg = print_msg('arquivo_nao_existe');
			$this->Grava_Erro(print_msg('db_err_arq'));
			echo $this->msg;
			$this->Banco->FechaConexao();
			die();
		}

		
		//Validamos se os downloads estao excedidos
		if (!$this->Valida_Downloads()){
			$this->msg = print_msg('downloads_excedidos');
			$this->Grava_Erro(print_msg(db_err_limit));
			$this->Banco->FechaConexao();
			echo $this->msg;
			die();
		}		

		//Valida se o IP ja baixou a quantidade suficientes
		if (!$this->Valida_IP()){
			$this->msg = print_msg('limite_downloads_ip');
			$this->Grava_Erro(print_msg(db_err_ip));			
			echo $this->msg;
			$this->Banco->FechaConexao();
			die();
		}		

		$this->Grava_Download();
		$this->SendFile();
		
	}	
		
}

?>
