<?php
/**
 * Classe de controle de usuario
 * @author Victor
 */
abstract class User extends Pessoa
{
	
	protected $usr_in_id; 
	protected $usr_st_login; 
	protected $usr_st_password;
	
	
	public abstract function create();
	public abstract function read();
	public abstract function update();
	public abstract function delete();
	
	
	/**
	 * Retorna usr_in_id
	 * @return integer
	 */
	public function getUserId() {
		return $this->usr_in_id;
	}
	 
	/**
	 * Set usr_in_id
	 * @param integer $usr_in_id
	 */
	protected function setUserId($usr_in_id) {
		$this->usr_in_id = $usr_in_id;
	}
	
	/**
	 * Retorna usr_st_login
	 * @return string
	 */
	public function getLogin() {
		return $this->usr_st_login;
	}
	 
	/**
	 * Set usr_st_login
	 * @param string $usr_st_login
	 */
	public function setLogin($usr_st_login) {
		$this->usr_st_login = $usr_st_login;
	}
	
	
	/**
	 * Retorna usr_st_password
	 * @return string
	 */
	public function getPassword() {
		return $this->usr_st_password;
	}
	 
	/**
	 * Set usr_st_password
	 * @param string $usr_st_password
	 */
	public function setPassword($usr_st_password) {
		$this->usr_st_password = $usr_st_password;
	}
	
	
	
	public function checkPasword($st_md5_pwd){
		if(!is_null($this->usr_st_password))
			if($this->usr_st_password == $st_md5_pwd)
				return TRUE;
		return FALSE;
	}
	
}

