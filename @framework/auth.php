<?php
/**
 * Controle de Autenticação
 * @author Victor
 *
 */
Class Auth 
{
	private $in_id;
	private $o_control;
	
	function __construct(Control &$o_control){
		
		$this->o_control = &$o_control;
		
		if (!$this->o_control->session()->isLogged()){
			//CASO NAO ESTEJA LOGADO
			//redireciona para a raiz do sistema
			if ($_SERVER['REQUEST_URI'] != $this->o_control->o_config->getParam('sis_uri'))
				$this->o_control->view()->redirectTo($this->o_control->o_config->getParam('sis_uri'));
				
			$this->logout();
		}
		else if($this->o_control->bootstrap()->getAction() == 'login')
			//CASO RECEBA UMA CHAMADA DE LOGIN
			$this->login();
		else{
			//CASO A SESSAO SEJA VALIDA
			if(isset($_SESSION['USER_ID'])){
				$user = new User();
				$this->o_control->setUser($user->userFactory($this->o_control, $_SESSION['USER_TYPE']));
				$this->o_control->user()->setId($_SESSION['USER_ID']);
				$this->o_control->user()->read_user();
			}
			
			//CASO RECEBA UMA CHAMADA DE LOGOUT
			if($this->o_control->bootstrap()->getAction() == 'logout')
				$this->logout();
		}
	}

	private function login()
	{	
		$o_params = new Params();
		if(isset($_REQUEST['action']))
		if($_REQUEST['action'] == 'login')
		{
			
			//Metodo para login normal
			if(strlen($st_username = trim($_POST['st_username'])) && strlen($st_password = trim($_POST['st_password'])))
			{
				
				$user = new UserDB($this->o_control);
				
				$user->setLogin($st_username);
				
				if(!$user->read())
					$this->o_control->view()->addException('Usuário não encontrado.');
				else{
					if($user->checkPasword(md5($st_password)))
					{
						$this->o_control->setUser($user);
						$this->o_control->session()->setSession($user->getUserId());
						return TRUE;
					}
					else{
						//aqui poderia vir uma rotina de recuperação de senha
						$this->o_control->view()->addException('Senha não confere');
					}
				}
			}
			else 
				$this->o_control->view()->addException('Usu&aacute;rio e senha devem ser preenchidos');
		}
		else if($_POST['action'] == 'definirsenha')
			$this->DefinirLogin();
		
		$this->o_control->view()->setView('Login', 'Acesso ao sistema de administração');
		return FALSE;
	}


	private function logout()
	{
		if($this->o_control->session()->isLogged())
		{
			$this->o_control->session()->unsetSession();
		}
		$this->login();
	}
}