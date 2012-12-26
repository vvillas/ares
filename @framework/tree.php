<?php
require_once 'sistema/database/Tree.php';

/**
 * Classe de Controle da Arvore do Sistema
 * @author Victor
 */
Class Tree extends TreeDatabase{

	private $o_control;
	private $tree;
	private $v_active_nodes;
	private $v_active_actions;
	public  $o_db;

	function __construct(Control $o_control)
	{
		$this->o_control = $o_control;
		$this->o_db = $this->o_control->o_db;
		$this->tree = new Node(0, 'root', 'root');
		$this->setTree();
		
		$this->setActiveNodes();
		$this->setActiveActions();
		
	}


	public function setActiveNodes()
	{
		$st_mod = $this->o_control->bootstrap()->getModulo();
		$st_sub = $this->o_control->bootstrap()->getSubmodulo();
		$st_com = $this->o_control->bootstrap()->getComando();
		$this->v_active_nodes = array($st_mod, $st_sub, $st_com);
	}

	/**
	 * Metodo de montagem dos Nós ativos
	 * amarrado, deve ser generalizado
	 * @return boolean
	 */
	function checkUserRights()
	{
		$mod = $this->o_control->bootstrap()->getModulo();
		$ctr = $this->o_control->bootstrap()->getSubmodulo();
		$com = $this->o_control->bootstrap()->getComando();
		
		if(!$o_mod = $this->tree->getSubNodeByPath($mod)){
			if($mod != 'inicio')
				$this->o_control->view()->addException("Você não tem permissão para acessar este conteúdo: $mod");
		}
		
		if(is_a($o_mod, 'Node')){
		if(!$o_ctr = $o_mod->getSubNodeByPath($ctr))
			if($ctr != 'inicio')
				$this->o_control->view()->addException("Você não tem permissão para acessar este conteúdo: $mod > $ctr");
		}
		else
			if($ctr != 'inicio')
				$this->o_control->view()->addException("Você não tem permissão para acessar este conteúdo: $mod > $ctr");
		
		if(is_a($o_ctr, 'Node')){
		if(!$o_com = $o_ctr->getSubNodeByPath($com))
			if($com != 'inicio')
				$this->o_control->view()->addException("Você não tem permissão para acessar este conteúdo: $mod > $ctr > $com ");
		}
		else
			if($com != 'inicio')
				$this->o_control->view()->addException("Você não tem permissão para acessar este conteúdo: $mod > $ctr > $com ");
	}

	/**
	 * Método para receber a arvore do sistema
	 * @return Node
	 */
	public function getTree()
	{
		return $this->tree;
	}

	/**
	 * Metodo que coleta os Nodes do usuario no banco
	 * E retornando positivo, constroi uma
	 * arvore de Nós de acesso do sistema
	 */
	public function setTree()
	{
		if($nds = $this->listNodes())
		{
			foreach ($nds as $key => $value)
			{
				if(is_null($nds[$key]->nod_in_parent)) //identifica os modulos por nao possuirem nod_in_parent
				{
					$o_node = new Node($nds[$key]->nod_in_id, $nds[$key]->nod_st_nome, $nds[$key]->nod_st_path, $nds);
					if(count($o_node))
						$this->tree->addSubNode($o_node);
				}
			}
		}
	}

	public function setActiveActions()
	{
		$v_paths = $v_actions = array();
		if($o_mod = $this->getTree()->getSubNodeByPath($this->o_control->bootstrap()->getModulo()))
		{
			$v_paths[] = $o_mod->getPath();
			if($o_sub = $o_mod->getSubNodeByPath($this->o_control->bootstrap()->getSubmodulo()))
			{
				$v_paths[] = $o_sub->getPath();
				if($o_com = $o_sub->getSubNodeByPath($this->o_control->bootstrap()->getComando()))
				{
					$v_paths[] = $o_com->getPath();
				}
			}
		}
		if(count($v_paths)>0)
			$v_actions = $this->listActions($v_paths);
		if(is_array($v_actions))
			foreach ($v_actions as $act)
			{
				$o_action = new Action($act->act_in_id, $act->act_in_tipo, $act->act_st_label, $act->act_st_path);
				$this->v_active_actions[] = $o_action;
			}
	}

	public function getActiveActions($param = NULL)
	{
		if(is_array($this->v_active_actions))
		{
			
			if(is_null($param))
				return $this->v_active_actions;
			else
			{
				$arr = array();
				if(is_numeric($param))
				{
					foreach ($this->v_active_actions as $action)
					{
						if($action->getTipo() == $param)
							$arr[] = $action;
					}
				}
				else
				{
					foreach ($this->v_active_actions as $action)
					{
						if($action->getPath() == $param)
							return($action);
					}
				}
				return $arr;
			}
		}
		return FALSE;
	}

}



