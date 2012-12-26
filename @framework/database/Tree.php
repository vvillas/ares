<?php
class TreeDatabase
{
	public function listNodes()
	{
		$st_query = "SELECT nod_in_id, nod_st_label, nod_st_path, nod_in_id_parent, usr_in_id_ctrl, nod_bo_status
						FROM fds.tbl_node
						WHERE nod_bo_status = TRUE ORDER BY nod_in_id ";
		try
		{
			return $this->o_db->execQuery('sys',$st_query)->getData();
		}
		catch (DDDException $e)
		{
			throw new DException($e->getMessage());
		}
	}
	
	public function listActions($v_active_nodes) 
	{
		if(is_array($v_active_nodes))
			$v_active_nodes = implode("','", $v_active_nodes);
			
		$st_query = "SELECT nod.nod_in_id, act.*
							FROM fds.tbl_nodes AS nod
							INNER JOIN(SELECT * FROM fds.tbl_command_node) AS con ON con.nod_in_id = nod.nod_in_id
							INNER JOIN(SELECT * FROM fds.tbl_actions) AS act ON act.act_in_id = actn.act_in_id
							WHERE 
								nod_bo_status = TRUE
								AND act.act_bo_status = TRUE
								AND nod.nod_st_path IN ('$v_active_nodes')
							ORDER BY act_in_id";
		
		try
		{
			$rs = $this->o_db->execQuery('sys',$st_query)->getData();
		}
		catch (DDDException $e)
		{
			throw new DException($e->getMessage());
		}
						
		return $rs;	
	}
}



