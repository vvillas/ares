<?php
class LogDatabase
{

	public function verifyLogAcesso($in_id)
	{
		$st_query = "SELECT lace_in_id,(age(now(),lace_ts_final) > '00:00:00') AS expired,lace_st_sessao 
							FROM controle_academico_ead.tbl_log_acesso
							WHERE pro_in_id = $in_id ORDER BY lace_in_id DESC LIMIT 1";
		try
		{
			$rs = $this->o_db->execQuery('sys',$st_query)->getData();
		}
		catch(PExceptionDB $e)
		{
		}
		if(count($rs))
			return $rs[0];
		return FALSE;
	}

	public function insertLogAcesso($in_user,$in_interval,$st_idioma,$st_navegador,$st_cliente,$st_sessao)
	{
		$st_query = "INSERT INTO controle_academico_ead.tbl_log_acesso (pro_in_id,lace_ts_final,lace_st_idioma,lace_st_navegador,lace_ip_cliente,lace_st_sessao)
						VALUES ($in_user,now() + '$in_interval Minutes','$st_idioma','$st_navegador','$st_cliente','$st_sessao') RETURNING lace_in_id";
		try
		{
			$this->o_db->execQuery('sys',$st_query);
		}
		catch(PExceptionDB $e)
		{
		}
	}

	public function updateLogAcesso($in_log,$in_interval)
	{
		$st_query = "UPDATE controle_academico_ead.tbl_log_acesso SET lace_ts_final = now() + '$in_interval Minutes' WHERE lace_in_id = $in_log";
		try
		{
			$this->o_db->execQuery('sys',$st_query);
		}
		catch(PExceptionDB $e)
		{
		}
	}

	public function insertLog($in_log,$st_modulo,$st_submodulo,$st_comando,$params)
	{
		if($st_comando)
			$st_comando = "'$st_comando'";
		else
			$st_comando = 'null';
			
		if($params)
		{
			$h_array = new ArrayHelper();
			$st_params = $h_array->flatten_array($params);
			$st_params = "'$st_params'";
		}
		else
			$st_params = 'null';
			
		$st_query = "INSERT INTO controle_academico_ead.tbl_log_params (lace_in_id,lpar_st_modulo,lpar_st_submodulo,lpar_st_comando,lpar_tx_params)
						VALUES ($in_log,'$st_modulo','$st_submodulo',$st_comando,$st_params)";
		try
		{
			$this->o_db->execQuery('sys',$st_query);
		}
		catch(PExceptionDB $e)
		{
		}
	}
}