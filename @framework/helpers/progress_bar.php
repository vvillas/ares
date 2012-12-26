<?php
/**
 * @author Victor
* controler do widget
* */

Class ProgressBar{

	private $st_label;
	private $in_percent;
	
	function __construct($in_percent, $st_label = NULL) 
	{
		if(is_int($in_percent));
			$this->in_percent = $in_percent;
			
		if(!is_null($st_label))
			$this->st_label = $st_label;
	}
	
	public function getPercent()
	{
		return $this->in_percent;
	}
	
	public function getLabel() 
	{
		return $this->st_label;
	}
	
}