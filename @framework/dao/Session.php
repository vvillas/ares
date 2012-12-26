<?php
class DAO_Session
{	
	private $o_control;
	public $o_db;
	
	function __construct(DDDatabase $o_db)
	{
		$this->o_db = &$o_db;
	}
	
	public function readSession($ses_in_id) {
		$filds = array('sess_in_id', 'sess_st_hash', 'sess_st_plataform', 'sess_bo_status');
		$rs = $this->o_db->read('controle_docente.tbl_session', $filds, array('sess_in_id = 12945', 'sess_bo_status = TRUE'));
		return $rs->getData();
	}
	
	public function insertSession($st_hash,$in_system,$in_timeout,$st_language,$st_plataform,$st_ip)
	{

		$st_query = "INSERT INTO controle_docente.tbl_session(
					            sess_st_hash, sess_st_plataform)
					    VALUES ('$st_hash', '$st_plataform')
					    RETURNING sess_in_id
					    ;";
		
		try
		{
			$rs = $this->o_db->execQuery('academico',$st_query)->getData();
		}
		catch(PExceptionDB $e)
		{
		}
		return $rs[0]->res;
	}

	public function updateSession($in_id, $in_timeout)
	{
		if($in_timeout == 0)
			$st_timeout = '1 Seconds';
		else
			$st_timeout = $in_timeout.' Minutes'; 
			
		$st_query = "SELECT controle_docente.sp_session_update($in_id,'$st_timeout')";
		try
		{
			$this->o_db->execQuery('academico',$st_query);
		}
		catch(PExceptionDB $e)
		{
		}
	}
	
	

}