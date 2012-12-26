<?php
/**
 * PHP - 03/11/2012
 * @filesource bootstrap.php
 * @package fds
 * @author victor
 * @version 1.0.0
 *
 */

class Bootstrap
{
	private $st_comando;
	private $st_submodulo;
	private $st_modulo;
	private $st_action;
	private $o_control;

	private $URI = array();
	
	function __construct(Control $o_control)
	{
		$this->o_control = $o_control;
		$this->setURI();
		$this->load();
	}

	public function getModulo()
	{
		return $this->st_modulo;
	}
	
	public function getSubmodulo()
	{
		return $this->st_submodulo;
	}
	
	public function getComando()
	{
		return $this->st_comando;
	}
	
	public function getAction()
	{
		return $this->st_action;
	}
	
	private function setURI() {
		if($_SERVER['REQUEST_URI'])
			$this->URI = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
	}
	
	public function isControl() 
	{
		if($this->URI[0] == ADM_URI)
			return TRUE;
		return FALSE;
	}
	
	private function load()
	{
		if(isset($_REQUEST['modulo']))
			$this->st_modulo = $_REQUEST['modulo'];
		else
			$this->st_modulo  = $this->o_control->o_config->getParam('modulo_default');
			
		if(isset($_REQUEST['submodulo']))
			$this->st_submodulo = $_REQUEST['submodulo'];
		else 
			$this->st_submodulo = $this->o_control->o_config->getParam('submodulo_default');

		if(isset($_REQUEST['comando']))
			$this->st_comando = $_REQUEST['comando'];
		else
			$this->st_comando = $this->o_control->o_config->getParam('comando_default');//
			
		if(isset($_REQUEST['action']))
			$this->st_action = $_REQUEST['action'];

	}
}