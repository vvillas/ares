<?php
/**
 * Classe para tratamento de array
 * @author Victor
 */
class ArrayHelper {

	/**
	 * Metodo que recebe um array e retorna uma string tipo [$key]=>$value
	 * @param unknown_type $param
	 * @return string
	 */
	public function flatten_array($array)
	{
		$str = "";
		if(is_array($array))
		foreach($array as $key => $value)
		{
			if(is_array($value))
				$str.= $this->flatten_array($value);
			else
				$str.= "[$key]=>$value;";
		}	
		return($str);
	}

	/**
	 * Metodo que testa se o parametro[$needle] é filho do array[$arr]
	 * Seja ele um parametro ou uma chave de um sub array
	 * @param $needle 		termo
	 * @param $arr			array
	 * @return boolean
	 */
	function isChild($needle, $arr) 
	{

		if(is_array($arr))
		{
			if(array_key_exists($needle, $arr))
			{
				if(is_array($arr[$needle]))
				{
					return TRUE;
				}
				else
					if(in_array($needle, $arr))
						return TRUE;
			}
			else 
			{
					return TRUE;
			}
		}					
		return FALSE;
	}
	
	
	
}