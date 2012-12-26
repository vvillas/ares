<?php
class Inicio
{
	private $o_control;
	private $o_db;
	
	function __construct(Control $o_control)
	{
		$this->o_control = $o_control;
		$this->o_db = $this->o_control->o_db;
		$this->o_control->view()->addJavaScript(SYS_PATH."sistema/js/functions.js");
	}
	
	public function inicio()
	{
		$params = new Params();
		
		$this->o_control->view()->setParams($params);
		$this->o_control->view()->setView('Inicio', 'Início');
	}

}