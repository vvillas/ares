<?php
class ConfigDB
{
	private $DataBases;

	function __construct()
	{
		$this->DataBases = array();
		
		//sys
		$this->DataBases['sys'] = new DDConnectSettings();
		$this->DataBases['sys']->setApplication(DDConnectSettings::MYSQL);
		$this->DataBases['sys']->setHost('localhost');
		$this->DataBases['sys']->setPort(5432);
		$this->DataBases['sys']->setDatabase('fds');
		$this->DataBases['sys']->setUser('root');
		$this->DataBases['sys']->setPassword('z010203');
	}
	
	public function listDBConfig()
	{
		return $this->DataBases;
	}
}