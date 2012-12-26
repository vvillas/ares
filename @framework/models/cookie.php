<?php
/**
 * Objeto de Manipulação de Cookies
 * @author Victor
 * @version
 * 
 */
class Cookie{
	
	private $st_name;
	private $params;
	private $ts_expires 	= NULL;
	private $st_path 		= '/';
	private $st_domain 		= NULL;
	private $bo_secure 		= FALSE;
	private $bo_httponly 	= FALSE;
	
	/** Construtor do Cookie
	 * @param string $st_name = Nome do Cookie */
	public function __construct($st_name = NULL){
		$this->params();
		if(!is_null($st_name)){
			$this->st_name = $st_name;
			$this->read();
		}
	}
	
	public function params(){
		if(!is_a($this->params, 'Params'))
			$this->params = new Params();
		return $this->params;
	}
	
	
	public function getName(){
	    return $this->st_name;
	}
	 
	public function setName($st_name){
	    $this->st_name = $st_name;
	}
	
	public function getParam($key){
		return $this->params->getParam($key);
	}
	 
	public function addParam($key, $value){
		$this->params->setParam($key,$value);
	}
	
	public function getPath() {
	    return $this->st_path;
	}
	 
	public function setPath($st_path){
	    $this->st_path = $st_path;
	}
	
	public function getExpires(){
	    return $this->ts_expires;
	}
	 
	public function setExpires($ts_expires) {
	    $this->ts_expires = $ts_expires;
	}
	
	public function getDomain() {
	    return $this->st_domain;
	}
	 
	public function setDomain($st_domain) {
	    $this->st_domain = $st_domain;
	}
	
	public function getSecure() {
	    return $this->bo_secure;
	}
	 
	public function setSecure($bo_secure) {
	    $this->bo_secure = $bo_secure;
	}
	
	public function getHttpOnly() {
	    return $this->bo_httponly;
	}
	 
	public function setHttpOnly($bo_httponly) {
	    $this->bo_httponly = $bo_httponly;
	}
	
	protected function read(){
		
		if(isset($_COOKIE[$this->st_name])){
			
			$cookie = json_decode($_COOKIE[$this->st_name]);

			if(!is_null($cookie)){
				foreach ($cookie as $key => $value) {
					$this->params()->setParam($key, $value);
				}
			}
		}
	}
	
	public function write(){
		
		setcookie(
					$this->st_name, 
					json_encode($this->params->getParams()), 
					$this->ts_expires,
					$this->st_path,
					$this->st_domain,
					$this->bo_secure, 
					$this->bo_httponly
		);
	}
}


