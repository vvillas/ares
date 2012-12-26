<?php
class Params
{
	private $v_params;
	
	function __construct()
	{
		$this->v_params = array();
	}
	
	public function setParam($st_titulo,$mx_valor)
	{
		$this->v_params[$st_titulo] = $mx_valor;
	}
	
	public function getParam($st_titulo)
	{
		if(isset($this->v_params[$st_titulo]))
			return $this->v_params[$st_titulo];
	}
}
