<?php
/**
 * Classe de gerenciamento de nó do sistema
 * @author Victor
 *
 */
Class Action{
	private $in_id;
	private $in_tipo;
	private $st_nome;
	private $st_path;

	/**
	 * Na construção recebe o Rótulo e o Path
	 * @param $in_tipo		Tipo 	- Para determinar o tipo 
	 * @param $st_nome		Rotulo 	- Nome legível
	 * @param $st_path		Path 	- Nome limpo
	 */
	function __construct($in_id, $in_tipo, $st_nome, $st_path)
	{
		$this->in_id 	= $in_id;
		$this->in_tipo 	= $in_tipo;
		$this->st_nome 	= $st_nome;
		$this->st_path 	= $st_path;
		
	}

	/**
	 * @return Rotulo
	 */
	public function getNome()
	{
		return $this->st_nome;
	}
	
	/**
	 * @return Tipo
	 */
	public function getTipo()
	{
		return $this->in_tipo;
	}

	/**
	 * @return Caminho
	 */
	public function getPath()
	{
		return $this->st_path;
	}
	
}


