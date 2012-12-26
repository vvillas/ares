<?php
/**
 Classe de Autenticação
 * @author Victor
 */
class AuthDatabase
{
	/**
	* Verifica o usuário, se for valido,
	* retorna os parametros, caso contrario retorna falso
	* @param string $st_user
	*/
	public function getUserLogin($st_user)
	{
		$st_query = "SELECT pes.*, pro_in_id, pro_st_username, pro_st_password, pro_st_hash, pro_in_level
							  FROM academico.tbl_professor AS pro
						INNER JOIN (SELECT pes_in_id, pes_st_nome, pes_st_email FROM public.tbl_pessoa WHERE pes_bo_status = TRUE) AS pes ON pes.pes_in_id = pro.pro_in_pessoa 
						WHERE pro_bo_status = TRUE
						AND pro_st_username = '$st_user'
						AND pro_in_status = 1";
		
		try
		{
			$v_user = $this->o_db->execQuery('sys',$st_query)->getData();
			if(isset($v_user[0]))
			{
				return $v_user[0];
			}
		}
		catch (DDDException $e)
		{
			throw new DException($e->getMessage());
		}
	}
	
	
	public function getUserPessoa($pes_in_id)
	{
		$st_query = "SELECT pes.*, pro_in_id, pro_st_username, pro_st_password, pro_st_hash, pro_in_level
						FROM academico.tbl_professor AS pro
						INNER JOIN (SELECT pes_in_id, pes_st_nome, pes_st_email FROM public.tbl_pessoa WHERE pes_bo_status = TRUE) AS pes ON pes.pes_in_id = pro.pro_in_pessoa
						WHERE pro_bo_status = TRUE
						AND pes_in_id = $pes_in_id";
		
		try
		{
			$v_user = $this->o_db->execQuery('sys',$st_query)->getData();
			if(isset($v_user[0]))
			{
				return $v_user[0];
			}
		}
		catch (DDDException $e)
		{
			throw new DException($e->getMessage());
		}
	}
	
	public function getUserOraculo($in_registro) 
	{
		$st_query = "";
		
		/*
		try
		{
			$v_user = $this->o_db->execQuery('sys',$st_query)->getData();
			if(isset($v_user[0]))
			{
				return $v_user[0];
			}
		}
		catch (DDDException $e)
		{
			throw new DException($e->getMessage());
		}
		*/
		return $v_user[0];
	}
	
}



