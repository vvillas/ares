<?php
class Benchmark{
	
	private $v_events = array();
	
	
	public function addEvent($name, $start = TRUE) 
	{
		$this->v_events[$name] = new Event($name, $start);
	}
	
}