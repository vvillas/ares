<?php

require_once SYS_PATH.'config/ConfigGlobal.php';
require_once SYS_PATH.'config/ConfigDB.php';


require_once SYS_PATH.'/session.php';


require_once SYS_PATH.'/view.php';
require_once SYS_PATH.'/output.php';
require_once SYS_PATH.'/auth.php';



require_once SYS_PATH.'/models/pessoa.php';
require_once SYS_PATH.'/models/user.php';
require_once SYS_PATH.'/database/UserDB.php';

require_once SYS_PATH.'/helpers/array_helper.php';
require_once SYS_PATH.'/helpers/string_helper.php';


class Control
{
	public $o_db;
	public $o_config;
	private $o_bootstrap;	
	private $o_session;
	private $o_sistema;
	private $o_tree;
	private $o_user;
	private $o_auth;
	private $o_view;
	private $o_log;
	private $benchmarch;
	
	public $params;
	

	function __construct()
	{

		//Inicializando o Tracking
		$this->track();
		
		//Chamando o metodo de execução 
		$this->run();
	}
	
	/**
	* Executando o sistema
	*/
	public function run()
	{
		//Objeto de Operacao da Sessao
		//$this->session();
		
		//Verifica se é uma chamada de administração
		//if(!$this->track()->isControl())
			$this->view()->setView('Front');
		//else
		{
			
			//Conectando com os bancos
			$this->connectDB();
			
			//Objeto de Controle de Autenticação
			//$this->auth();
			
			//Redireciona para o metodo de Login caso não esteja logado
			//if($this->session()->isLogged())
			{
				//Inicializando o Objeto Log
				//$this->log();
				
				//Inicializando a Arvore de Modulos do Sistema
				$this->tree();
			
			}
			//else 
			{
				$this->__destruct();
			}
		}
		/*
		
		//CONSTRUÇÂO
		//Verifica se a pasta chamada como modulo exite
		if(!is_dir(APP_PATH.'modulo_'.$this->o_bootstrap->getModulo()))
			throw new Exception('Módulo '.APP_PATH.'modulo_'.$this->o_bootstrap->GetModulo().' não encontrado');
		else 
		{
			//Verifica se a pasta chamada contem o arquivo com o nome do submodulo
			$st_submodulo = $this->o_bootstrap->getSubmodulo();
			$st_arquivo = 'modulo_'.$this->o_bootstrap->getModulo().'/'.$st_submodulo.'.php';
			
			if(!file_exists(APP_PATH.$st_arquivo))
				$this->view()->addException("Submódulo '$st_arquivo' não encontrado");
			else
			{	
				
				//recebe o arquivo do submodulo
				require_once APP_PATH.$st_arquivo;
				
				//verifica se a classe existe
				if(!class_exists($st_submodulo))
					$this->view()->addException("Classe '$st_submodulo' não encontrada");
				else
				{
					//constroi o submodulo
					$o_classe = new $st_submodulo($this);
					
					//verifica se o metodo com o nome do comando existe
					$st_comando = $this->o_bootstrap->getComando();
					if(!method_exists($o_classe, $st_comando))
						$this->view()->addException("Comando '$st_comando' não pode ser encontrado");
					else
					{
						//confere as permissões do usuário antes de executar a operação
						//$this->tree()->checkUserRights();
						
						//verifica se houve a chamada de alguma ação
						$st_action = $this->bootstrap()->getAction();
						if(!is_null($st_action))
							if(!method_exists($o_classe, $st_action))
								$this->view()->addException("A ação '$st_action' não pode ser encontrada");
							else 
								$o_classe->$st_action();
						
						//executa o comando
						$o_classe->$st_comando();
						
					}
				}
			}
		}
		*/
	}

	/**
	 * Metodo de acesso ao banco de dados
	 */
	private function connectDB()
	{
		$o_dbconfig = new ConfigDB();
		$v_dbconfig = $o_dbconfig->listDBConfig();
		
		if(count($v_dbconfig))
		{
			$this->o_db = new DDDatabase();
			foreach($v_dbconfig AS $key => $value)
			{
				try
				{
					$this->o_db->setConnectSettings($key, $value);
				}
				catch (DDDException $e)
				{
					$this->output($e->getMessage());
				}
			}
		}
	}
	
	
	/**
	* Executa a classe de configuração e carrega os parametros
	*/
	private function loadConfig()
	{
		$o_ConfigGlobal = new ConfigGlobal();
		$this->o_config = $o_ConfigGlobal->getConfig();
	}
	
	/**
	*Inicia a sessão, caso a mesma ainda não esteja iniciada
	*@return Session
	*/
	public function session()
	{
		if(!is_a($this->o_session,'Session'))
		{
			$this->o_session = new Session($this);
		}
		return $this->o_session;
	}
	
	public function auth()
	{
		if(!is_a($this->o_auth,'Auth'))
		{
			$this->o_auth = new Auth($this);
		}
		return $this->o_auth;
	}
	
	
	/**
	 * Metodo para receber o usuário
	 * @param User $user
	 */
	public function user() {
		return $this->getUser();
	}
	public function setUser($user){
		$this->o_user = $user;
	}
	
	public function getUser(){
		return $this->o_user;
	}
	
	
	/**
	 * Metodo de chamada do obj Log
	 * @return Log
	 */
	public function log() 
	{
		if(!is_a($this->o_log , 'Log')){
			
			require_once SYS_PATH.'/log.php';
			require_once SYS_PATH.'/database/Log.php';
			
			$this->o_log = new Log($this);
		}
		return $this->o_log;
	}
	
	
	/**
	 * Metodo de chamada do obj Bootstrap
	 * @return Bootstrap
	 */
	public function track() 
	{
		/*
		if(!is_a($this->o_bootstrap , 'Bootstrap')){
			require_once SYS_PATH.'/bootstrap.php';
			$this->o_bootstrap = new Bootstrap($this);
		}
		
		return $this->o_bootstrap;
		*/
	}

	/**
	 * Metodo para chamada do obj Tree
	 * @return Tree
	 */
	public function tree() 
	{
		if(!is_a($this->o_tree, 'Tree')){
			require_once SYS_PATH.'/tree.php';
			require_once SYS_PATH.'/models/node.php';
			require_once SYS_PATH.'/models/action.php';
			$this->o_tree = new Tree($this);
		}

		return $this->o_tree;
	}
	
	
	/**
	 * Metodo para chamada do obj View
	 * @return View
	 */
	public function view() 
	{
		if(!is_a($this->o_view, 'View')){
			
			$this->o_view = new View($this);
		}
		return $this->o_view;
	}
	
	
	/**
	 * Enter description here ...
	 * @param unknown_type $st_mensagem
	 */
	public function output($st_mensagem)
	{
		//if($this->o_config->getParam('bo_debug_mode') == TRUE)
			$this->view()->addException($st_mensagem);
		
			$this->view()->setView('modulo_inicio/view/erro.php', 'Erro');
		

			//header("HTTP/1.0 404 Not Found"); 
			//header("Status: 404 Not Found");
		
	}
	
	public function Benchmark() 
	{
		if(!is_a($this->benchmarch, 'Benchmark')){
			require_once SYS_PATH.'models/benchmark.php';
			require_once SYS_PATH.'models/event.php';
			$this->benchmarch = new Benchmark();
		}
	}
	
	
	/**
	 * Show the Output AND Kill da funcking sistem
	 */
	function __destruct()
	{
		//exibe o resultado e encerra a operação
		$this->view()->show();
		
		if(AMBIENT == 'developement')
			var_dump($_COOKIE);
		
		exit();
	}
}

