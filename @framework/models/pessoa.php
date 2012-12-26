<?php
/**
 * Objeto Pessoa 
 * @author Victor
 *
 */
abstract class Pessoa 
{
	protected $per_in_id;
	protected $per_st_name;
	protected $per_st_shortname;
	protected $per_st_email;
	
	
	/**
	 * Retorna per_in_id
	 * @return integer
	 */
	public function getPersonId() {
		return $this->per_in_id;
	}
	 
	/**
	 * Set per_in_id
	 * @param integer $per_in_id
	 */
	protected function setPersonId($per_in_id) {
		$this->per_in_id = $per_in_id;
	}
	
	/**
	 * Retorna per_st_nome
	 * @return string
	 */
	public function getName() {
		return $this->per_st_nome;
	}
	 
	/**
	 * Set per_st_nome
	 * @param string $per_st_nome
	 */
	public function setName($per_st_nome) {
		$this->per_st_nome = $per_st_nome;
	}
	
	/**
	 * Retorna per_st_shortname
	 * @return string
	 */
	public function getShortname() {
		return $this->per_st_shortname;
	}
	 
	/**
	 * Set per_st_shortname
	 * @param string $per_st_shortname
	 */
	public function setShortname($per_st_shortname) {
		$this->per_st_shortname = $per_st_shortname;
	}
	
	/**
	 * Retorna per_st_email
	 * @return string
	 */
	public function getEmail() {
		return $this->per_st_email;
	}
	 
	/**
	 * Set per_st_email
	 * @param string $per_st_email
	 */
	public function setEmail($per_st_email) {
		$this->per_st_email = $per_st_email;
	}
	
	
}
