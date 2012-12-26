<?php
class SessionDatabase
{	
	private $o_control;
	public $o_db;
	
	function __construct(Control &$o_control)
	{
		$this->o_control = &$o_control;
		$this->o_db = &$this->o_control->o_db;
	}
	
	public function verifySession($usr_in_id)
	{
		$st_query = 'SELECT sess_in_id, sess_ts_final, usr_in_id
						FROM fds.tbl_session
						WHERE usr_in_id = '.$usr_in_id;
		try	{
			$data = $this->o_db->execQuery('sys',$st_query)->getData();
		}
		catch (Exception $e){
			return $e;
		}
		
		if(count($data) > 0)
		{
			return $data[0];
		}
		
	}

	public function insertSession($in_timeout, $usr_in_id)
	{
		$in_timeout = $in_timeout*100;
		$st_query = "INSERT INTO fds.tbl_session (sess_ts_final, usr_in_id)
							VALUES((NOW() + $in_timeout) , $usr_in_id);";
		try
		{
			$this->o_db->execQuery('sys',$st_query);
		}
		catch(PExceptionDB $e)
		{
			return $e;
		}
		
		$st_query = "SELECT LAST_INSERT_ID() AS sess_in_id;";
		$rs = $this->o_db->execQuery('sys',$st_query)->getData();
		return $rs[0]->sess_in_id;
	}

	public function updateSession($sess_in_id, $in_timeout)
	{
		$in_timeout = $in_timeout*100;
		$st_query = "UPDATE fds.tbl_session
						SET sess_ts_final = (NOW() + $in_timeout)
						WHERE sess_in_id = $sess_in_id;";
		
		try
		{
			$rs = $this->o_db->execQuery('sys',$st_query);
		}
		catch(PExceptionDB $e)
		{
			return $e;
		}
		return TRUE;
	}

	public function insertSessionLog($in_session,$in_command)
	{
		$st_query = "SELECT controle_academico_ead.sp_session_log_insert($in_session,$in_command) AS res";
		try
		{
			$rs = $this->o_db->execQuery('sys',$st_query);
		}
		catch(PExceptionDB $e)
		{
		}
		return $rs[0]->res;
	}

	public function insertSessionLogParameter($in_session_log,$st_parameter,$st_value)
	{
		$st_query = "INSERT INTO controle_academico_ead.tbl_session_log_parameters(spar_in_session_log,spar_st_parameter,spar_st_value)
							VALUES ($in_session_log,'$st_parameter','$st_value')";
		try
		{
			$this->o_db->execQuery('sys',$st_query);
		}
		catch(PExceptionDB $e)
		{
		}
	}
}