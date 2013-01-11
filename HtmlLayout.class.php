<?php
/*
 .---------------------------------------------------------------------------.
|  Software: PHPMailer - PHP email class                                    |
|   Version: 1.0                                                            |
|   Contact: http://cargocollective.com/ulle							    |
| ------------------------------------------------------------------------- |
|    Author: André Ulle          								            |
| ------------------------------------------------------------------------- |
|   License: Distributed under the Lesser General Public License (LGPL)     |
|            http://www.gnu.org/copyleft/lesser.html                        |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
'---------------------------------------------------------------------------'
 * 
 */

class HtmlLayout {
	private $_getLayout;
	
	function __construct($_myLayout){
		$file = fopen(realpath($_myLayout), "r");
		$this->_getLayout = stream_get_contents($file);
		
		fclose($file);
		//$this->includes();
	
	}
	
	//Altera o Valor da pseudoVariável para cada ocorrência
	function changeValue($param,$replace){
		$this->_getLayout = preg_replace('/%'.$param.'%/' , $replace, $this->_getLayout,1);
	}
	
	//Altera o Valor da pseudoVariável em todas as ocorrências
	function changeAllValue($param,$replace){
		$this->_getLayout = str_replace("%".$param."%", $replace, $this->_getLayout);
	}
	
	//Cria um laço de repetição
	function listItem($param){
		preg_match('/(<!--%'.$param.'%-->)[\s\S]*(\<!--%'.$param.'%-->)/',$this->_getLayout,$matches);
		$list = str_replace('<!--%'.$param.'%-->',"",$matches[0]);
		$this->_getLayout = str_replace($matches[0], $list.$matches[0], $this->_getLayout);
	}
	
	function parcialList($param){
		$parcial = "";
		preg_match('/(<!--%'.$param.'%-->)(.|\\n)*(<!--%'.$param.'%-->)/',$this->_getLayout,$matches);
		$list = str_replace('<!--%'.$param.'%-->',"",$matches[0]);
		$parcial = str_replace($matches[0], $list.$matches[0],$list);
		return $parcial;
	}
	
	
	//Inclui arquivos comuns
	function useincludes($param,$page){
		$file = fopen(realpath($page), "r");
		$subject = stream_get_contents($file);
		$this->_getLayout = preg_replace('(<!--%'.$param.'%-->)' , $subject, $this->_getLayout,1);
		fclose($file);
	}
	
	
	//Remove o encadeamento
	function cutText($param){
		preg_match('/(<!--%'.$param.'%-->)[\s\S]*(<!--%'.$param.'%-->)/',$this->_getLayout,$matches);
		$this->_getLayout = str_replace($matches[0], "", $this->_getLayout);
	}
	
	function getLayout(){
		return $this->_getLayout;
	}
	
}
?>