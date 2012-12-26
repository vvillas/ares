<?php
/**
 * Classe de gerenciamento de nó do sistema
 * @author Victor
 *
 */
Class Node{
	private $in_id;
	private $st_nome;
	private $st_path;
	private $bo_active;

	public $v_sub_node;
	public $v_actions;

	/**
	 * Na construção recebe o Rótulo e o string limpo
	 * @param $st_nome		Rotulo - Nome legível
	 * @param $st_path		Caminho - Nome limpo
	 * @param $arr			Array de Nós Encadeados
	 */
	function __construct($in_id, $st_nome, $st_path, $arr = NULL)
	{
		$this->in_id 		= $in_id;
		$this->st_nome 		= $st_nome;
		$this->st_path 		= $st_path;
		
		if(is_array($arr))
			$this->setChilds($arr);
			
	}

	/**
	 * @return Rotulo
	 */
	public function getNome()
	{
		return $this->st_nome;
	}

	/**
	 * @return Caminho
	 */
	public function getPath()
	{
		return $this->st_path;
	}


	/**
	 * Enter description here ...
	 * @param Node $o_node
	 */
	public function addSubNode(Node $o_node)
	{
		$this->v_sub_node[] = $o_node;
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $arr
	 */
	public function setChilds($arr)
	{
		foreach ($arr as $key => $value)
		{
			if($arr[$key]->nod_in_parent == $this->in_id)
			{
				$o_node = new Node($arr[$key]->nod_in_id,$arr[$key]->nod_st_nome, $arr[$key]->nod_st_path, $arr);
				$this->addSubNode($o_node);
			}
		}
	}
	
	
	/**
	 * Enter description here ...
	 * @param Node $o_node
	 */
	public function addAction(Node $o_action)
	{
		$this->v_actions = $o_action;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $arr
	 */
	public function setActions($arr)
	{
		if(is_array($arr))
		foreach ($arr as $key => $value)
		{
			$o_action = new Node($arr[$key]->nod_in_id,$arr[$key]->nod_st_nome, $arr[$key]->nod_st_path, $arr);
			$this->addAction($o_action);
		}
	}

	/**
	 * Enter description here ...
	 * @return Array de Objetos Node
	 */
	public function getChildNodes()
	{
		return $this->v_sub_node;
	}
	
	/**
	 * metodo para retornar um nó filho
	 * @param string $nome Nome do nó que se deseja receber
	 * @return Node - Nó filho pedido/ FALSE se não encontrar o nó 
	 */
	public function getSubNodeByPath($path)
	{
		if(is_array($this->v_sub_node))
		if(count($this->v_sub_node))
		{
			foreach ($this->v_sub_node as $o_node)
			{
				if ($o_node->st_path == $path)
					return $o_node;
			}
		}
		return FALSE;
	}
	

}


