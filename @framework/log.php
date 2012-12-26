<?php
require_once 'sistema/database/Log.php';
class Log extends LogDatabase
{
	private $o_control;
	private $in_id;
	public  $o_db;

	function __construct(Control $o_control)
	{
		$this->o_control = $o_control;
		$this->o_db = $this->o_control->o_db;

		if($o_control->session()->isLogged())
		{
			if($log = $this->verifyLogAcesso($o_control->user()->getId()))
			{
				$this->updateLogAcesso($log->lace_in_id, $this->o_control->o_config->getParam('in_session_time'));
				$this->in_id = $log->lace_in_id;
			}
			else
				$this->in_id = $this->insertLogAcesso($this->o_control->user()->getId(), $this->o_control->o_config->getParam('in_session_time'), $_SERVER['HTTP_ACCEPT_LANGUAGE'],$_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR'],session_id());
		}
		
		if(isset($this->in_id))
			$this->insertLog(	$this->in_id, 
								$this->o_control->bootstrap()->getModulo(), 
								$this->o_control->bootstrap()->getSubmodulo(),
								$this->o_control->bootstrap()->getComando(),
								$_POST);
	}
	
	public function getID()
	{
		return $this->in_id;
	}
	
}
