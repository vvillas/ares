<?php
require_once SYS_PATH."dao/Session.php";

class Session
{
	private $o_control;
	private $o_cookie;
	
	protected $dao_session;
	
	private $sess_in_id;
	private $sess_st_hash;
	private $sess_in_system;
	private $sess_st_plataform;
	private $sess_ip_client;
	
	
	function __construct(Control $o_control)
	{
		$this->o_control = &$o_control;
		$this->dao_session = New DAO_Session($this->o_control->o_db);
		$this->setHash();
		
		//Cria o Cookie de Controle do Sistema
		$this->o_cookie = new Cookie($this->o_control->o_config->getParam('sis_cookie_name'));
		$this->o_cookie->setExpires($this->o_control->o_config->getParam('sis_cookie_expires'));
		$this->o_cookie->setPath(SISURI);
		$this->o_cookie->setDomain(URL_PATH);
		$this->o_cookie->setSecure(TRUE);
		$this->o_cookie->setHttpOnly(TRUE);
		
		//Caso o Cookie tenha o parametro ID
		if($this->o_cookie->getParam('id')){
			//Caso a Sessao seja valida
			if($params = $this->dao_session->readSession($this->o_cookie->getParam('id'))){
				if(count($params)){
					$this->setId($params[0]->sess_in_id);
				}
			}
		}
		
		
		if(!is_null($this->sess_in_id)){
			$this->setSession();
			$this->o_cookie->params()->setParam('id', $this->sess_in_id);
		}
		
		$this->o_cookie->write();
	}
	
	public function setId($in_id)
	{
		$this->sess_in_id = (int)$in_id;
	}
	
	public function getId()
	{
		return $this->sess_in_id;
	}
	
	public function isLogged()
	{
		return $this->sess_in_id;
	}
	
	
	public function getHash(){
	    return $this->sess_st_hash;
	}
	 
	/**
	 * Metodo que recebe o ID do usuario para concatenar no sess_st_hash da sessao
	 * @param unknown_type $user_id
	 */
	public function setHash(){
	    $this->sess_st_hash = sha1(uniqid());
	}
	
	public function setSession(){
		
		if(is_int($this->sess_in_id))
			$this->dao_session->updateSession($this->sess_in_id, $this->o_control->o_config->getParam('in_session_time'));
		else 
			$this->setId($this->dao_session->insertSession(session_id(), 2, $this->o_control->o_config->getParam('in_session_time'), $_SERVER['HTTP_ACCEPT_LANGUAGE'], $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']));
			

	}
	
	public function unsetSession()
	{
		$this->bo_logged = $_SESSION['logged'] = false;
		$this->dao_session->updateSession($this->sess_in_id,0);
	} 
}