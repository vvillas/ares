<?php
class ConfigGlobal
{
	private $o_Params;
	function __construct()
	{
		$this->o_Params = new Params();		
		$this->o_Params->setParam('st_system_title', 'Ferreira da Silva - Sociedade de Advogados');		
		$this->o_Params->setParam('bo_debug_mode',TRUE);
		
		
		$this->o_Params->setParam('fl_default_output' , Output::HTML);
		
		$this->o_Params->setParam('modulo_default', 'inicio');		//define o modulo inicial do software
		$this->o_Params->setParam('submodulo_default', 'inicio');	//define o submodulo inicial do software
		$this->o_Params->setParam('comando_default', 'inicio');		//define o comando inicial do software
		
		$this->o_Params->setParam('in_session_time',10);//minutos
		
		//Nome do Template
		$this->o_Params->setParam('st_default_template','ares_one');
		define('TPL_PATH', 	'http://'.$_SERVER['HTTP_HOST'].'/templates/'.$this->o_Params->getParam('st_default_template'));

		//Lista de Widgets
		$widgets = array ('sis_controls', 'sis_breadcrumb', 'usr_menu', 'usr_toolbar');
		$this->o_Params->setParam('widgets', serialize($widgets));
		
		
	}
	
	public function getConfig()
	{
		return $this->o_Params;
	}
	
}