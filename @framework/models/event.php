<?php
class Event {
	
	private $st_name;
	private $ts_start;
	private $ts_end;
	
	
	function __construct($st_name, $bo_start = TRUE){
		$this->st_name = $st_name;
		if($bo_start)
			;
			
	}
		
	function start() {
		$this->ts_start = time();
	}
	
	function end(){
		$this->ts_end = time();
	}
	
	function getTempo($param) {
		;
	}
}