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

//Acesso direto nao eh permitido
if (!defined('IN_ADZ')){ die("<b>Direct Access not allowed</b>"); }

class IPB_FORUM {
	
	//Variaveis com dados
	private $dt;
	private $hr;
	private $ip;
	private $browser;
	private $platform;
	private $get_file;
	private $referer;
	
	
	//Variaveis para outras classes
	private $Banco;
	private $IPB;	
	
	//Variaveis de banco	
	private $consulta_banco;	
	private $res;
	private $result;
	
	//Variaveis do invision
	public $membro_nome;
	public $membro_posts;
	public $membro_id;

	private function Valida_Login(){
		$this->membro_id = $this->IPB['id'];
		if(!$this->membro_id >= "1"){ return false; }
		else{ return true; }
	}

	//Valida se o minimo de posts definido no arquivo de config est� esgotado.	
	private function Valida_Posts(){
		$this->membro_posts = $this->IPB['posts'];				
		if($this->membro_posts >= loadconfig('minimo_posts')){ return true; }
		else { return false; }
	}
	
	//Valida se o Usuario nao baixou o numero de vezes definido na config
	private function Valida_User(){
		$this->membro_nome = $this->IPB['name'];		
		$this->consulta_banco = "SELECT COUNT(*) FROM downloads WHERE dia='".$this->dt."' AND user='".$this->membro_nome."'";		
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);
		$this->result = mysql_result($this->res, 0);
				
		if ($this->result >= loadconfig('limite_user')){ return false; }
		else { return true; }
	}
	
	//Loga no banco em caso de erro
	private function Grava_Erro($bco_msg){
		$this->consulta_banco = 'INSERT INTO `falhas` (`ip`, `reverso`, `arquivo`, `dia`, `hora`, `referer`, `user`, `posts`, `browser`, `so`, `motivo`) VALUES (\''.$this->ip.'\', \''.gethostbyaddr($this->ip).'\', \''.$this->get_file.'\', \''.$this->dt.'\', \''.$this->hr.'\', \''.$this->referer.'\', \''.$this->IPB['name'].'\', \''.$this->IPB['posts'].'\', \''.$this->browser.'\', \''.$this->platform.'\', \''.$bco_msg.'\');';		
		$this->res = mysql_query($this->consulta_banco,$this->Banco->condb);
	}
	
	function __construct(){
		
		$this->Banco = new Banco;
		$this->Navegador = new Navegador;
		
		$this->referer = $_SERVER['HTTP_REFERER'];
		$this->get_file = $_GET['file'];
		$this->dt = date(y)."-".date(m)."-".date(d);
		$this->hr = date(G).":".date(i).":".date(s);
		$this->ip = $_SERVER["REMOTE_ADDR"];
		$this->browser = $this->Navegador->Name." ".$this->Navegador->Version;
		$this->platform = $this->Navegador->Platform;

		global $ipsclass;		
		$this->IPB = $ipsclass->member;

			if(!$this->Valida_Login()){
				$this->msg = print_msg('usuario_nao_logado');
                                $this->Grava_Erro(print_msg('db_err_login'));
                                echo $this->msg;
                                die();				
			}
		
			if(loadconfig('limite_user') != "0"){
				//Valida se o usuario nao baixou mais do que o permitido								
				if(!$this->Valida_User()){					
					$this->msg = print_msg('limite_downloads_user');
					$this->Grava_Erro(print_msg('db_err_user'));
					echo $this->msg;
					die();
				}
			}
			
			if(loadconfig('minimo_posts') != "0"){
				//Valida se o usuario ja nao baixou a quantidade de vezes especificadas na config
				if (!$this->Valida_Posts()){
					$this->msg = print_msg("sem_quantidade_posts");					
					$this->Grava_Erro(print_msg('db_err_posts'));
					echo $this->msg;
					$this->Banco->FechaConexao();
					die();
				}
			}
			$this->Banco->FechaConexao();			 
		}
	}
	
?>
