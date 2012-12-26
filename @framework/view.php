<?php
class View
{
	private $st_template;
	private $o_params;
	private $st_view;
	private $st_titulo_pag;
	private $st_contents;
	private $v_headers;
	private $v_widgets;
	private $v_exceptions;
	
	public 	$o_control;
	
	function __construct( Control $o_control)
	{
		$this->o_control = $o_control;
		$this->o_params = new Params();
		
		
		
		if($o_control->session()->isLogged())
		{
			$this->getUserMenu();
			$this->getUserToolbar();
			$this->setWidgets();
		}
	}

	public function setParams(Params $o_params)
	{
		$this->o_params = $o_params;
	}
	
	public function getParams()
	{
		return $this->o_params;
	}
	
	/**
	 * Metodo para redirecionar a pagina
	 * @param unknown_type $path
	 */
	public function redirectTo($uri)
	{
		if($_SERVER['REQUEST_URI'] != $uri)
			header("Location: $uri");
	}
	
	
	
	/**
	 * Retorna o nome da Página Chamada
	 * @return string
	 */
	public function getPageTitle() {
		return $this->st_titulo_pag;
	}
	
	
	
	/**
	 * Metodo para Definir a View
	 * @param unknown_type $st_view $st_contents
	 * @param unknown_type $st_titulo
	 */
	public function setView($st_view, $st_titulo = NULL)
	{
			
		if($st_titulo != 'Erro')
			$st_view = APP_PATH."modulo_".$this->o_control->bootstrap()->getModulo()."/view/".$st_view.".php";
	
		if(file_exists($st_view)){
			$this->st_view = $st_view;
			$this->st_titulo_pag = ($st_titulo) ? NULL : '';
			
		}
		else
			$this->addException('arquivo '.$st_view.' não encontrado');
		
		$this->st_titulo_pag = $st_titulo;
		
	}
	
	
	/**
	 * Metodo que constroi a saida
	 * @return string streaming com a saida
	 */
	public function getContents()
	{
		//recebendo os paramentros
		$params = $this->o_params;
		
		if(!file_exists($this->st_view))
			exit ('Arquivo de view não encontrado: '.$this->st_view);
		else
		{
			ob_start();
			//chamada da view
			include_once $this->st_view;
			$this->st_contents = ob_get_contents();
		}
	}
	
	
	
	/**
	 * Metodo que constroi a saida com template
	 * @throws DException		em caso de erro
	 * @return string			streaming com o toda a saida
	 */
	public function getContentsTemplate()
	{
		//Captura do Streaming da View
		$st_template = SYS_PATH.'/templates/'.$this->o_control->o_config->getParam('st_default_template').'/template.php';
		if(file_exists($st_template))
		{
			include_once($st_template);
		}
		else
		{
			echo $st_mensagem = 'arquivo "'.$st_template.'" não encontrado';
		}		
	}
	
	public function show($bo_template = TRUE)
	{
		//Captura do Buffer da View
		if($bo_template)
			$this->st_contents = $this->getContentsTemplate();
		else
			$this->st_contents = $this->getContents();
		
		echo $this->st_contents;
	}
	
	/**
	 * Metodo que relaciona os widgets
	 * @throws DException
	 */
	public function setWidgets()
	{
		$widgets = unserialize($this->o_control->o_config->getParam('widgets'));
		if(is_array($widgets))
		{
			foreach ($widgets as $value)
			{
				$o_widget = new stdClass();
				$path = "sistema/widgets/".$value.".php";
				if(file_exists($path))
				{
					var_dump($this);
					$o_widget->name = $value;
					$o_widget->view = $path;
					ob_start();
					require_once $o_widget->view;
					$o_widget->stream = ob_get_clean();
					$this->v_widgets[$o_widget->name] = $o_widget;
				}
				else
					throw new DException('arquivo '.$value.' não encontrado');
	
			}
		}
	}
	
	public function getUserMenu()
	{
		$this->o_params->setParam('v_user_menu',$this->o_control->tree()->getTree()->getChildNodes());
	}
	
	
	public function getUserToolbar()
	{
		$this->o_params->setParam('v_user_toolbar', $this->o_control->tree()->getActiveActions(1));
	}
	
	public function showWidget($st_widget_name, $return = "echo")
	{
		if(isset($this->v_widgets[$st_widget_name]))
		{
			if($return == "echo")
				echo $this->v_widgets[$st_widget_name]->stream;
			else if($return == "return")
				return $this->v_widgets[$st_widget_name]->stream;
		}
		return NULL;
	}
	
	public function showLeftBar() 
	{
		$leftBar = $this->showWidget('usr_menu', "return");
		return $leftBar;
	}
	
	public function showProgressBar($in_percent, $st_label = NULL)
	{
		if(is_numeric($in_percent))
		{
			require_once SYS_PATH.'/helpers/progress_bar.php';
			$o_progBar = new ProgressBar($in_percent, $st_label);
			include SYS_PATH.'/helpers/view/vProgressBar.php';
		}
	}
	
	public function showActionButton($st_label, $name, $value)
	{
		$this->o_params->setParam('action_value', $value);
		$this->o_params->setParam('action_name', $name);
		if($o_action = $this->o_control->tree()->getActiveActions($st_label))
			include SYS_PATH.'/widgets/view/vActionButton.php';
	}
	
	
	/**
	 * Metodo para gerenciamento de exceções
	 * @param $exception 	= Exception / String
	 * @param $code 		= Codigo / Nivel da Exception :: E_ERROR, E_NOTICE...
	 */
	public function addException($exception, $code = E_ERROR) 
	{
		if(is_a($exception, 'Exception'))
			$this->v_exceptions[] = $exception;
		else
		{
			$e = new Exception($exception, $code);
			$this->v_exceptions[] = $e;
		}
	}
	
	/**
	 * Metodo para receber as exeções registradas
	 * @param $code E_ERROR, E_NOTICE...
	 * @return Ambiguous|Exception
	 * @usage getExceptions(E_NOTICE) // para retornar as exceções do tipo noticia
	 */
	public function getExceptions($code = E_ALL)
	{
		if($code != E_ALL)
		{	$v_ex = array();
			foreach ($this->v_exceptions as $e) 
				if($e->getCode() == $code)
					$v_ex[] = $e;
			return $v_ex;
		}
		else
			return $this->v_exceptions;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $code
	 */
	public function showExceptions($code = E_ALL) 
	{
		if($v_exceptions = $this->getExceptions($code))
		{
			include SYS_PATH.'/helpers/view/vExceptions.php';
		}
	}
	
	public function addJavaScript($st_path)
	{
		if(!is_array($this->v_headers))
		{
			$js[] = $st_path;
			$this->v_headers['js'] = $js;
		}
		else
		{
			array_push($this->v_headers['js'], $st_path);
		}
	}
	
	public function echoJavaScripts()
	{
		$js_files = $this->v_headers['js'];
		if(is_array($js_files))
			include SYS_PATH.'/helpers/view/vJavascriptHeaders.php';
	}
}




