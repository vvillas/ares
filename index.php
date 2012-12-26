<?php

/**
 * PHP - 03/11/2012
 * @filesource index.php
 * @package ares
 * @author victor
 * @version 1.0.0
 * 
 */


/**
 * Definição do Ambiente de Execução
 * @var string $ambient
 */
$ambient = 'developement';
define('AMB_MODE', $ambient);
switch ($ambient) {
	case 'developement':
		error_reporting(E_ALL);
		break;
	case 'homologation':
		error_reporting(E_ERROR);
		break;
	case 'production':
	default:
		error_reporting(0);
		break;
}



/**
 * Setup de Parametros
 *  
 */
define('SYS_DIR', '@framework');
define('APP_DIR', '@application');
define('ADM_URI', 'ctrl');

define('SYS_TTL', 'ARES');
define('APP_TTL', 'Nome da Aplicação');


/**
 *	Definição da Raiz do Sistema
 *	@var string BASE_PATH
 */
$this_path_info = pathinfo(__FILE__);
$base_path = $this_path_info['dirname'].'/';
define('BASE_PATH', $base_path);


/**
 *	Definição da Pasta do Sistema
 *	@var string SYS_PATH
 */
if(is_dir(BASE_PATH.SYS_DIR))
	define('SYS_PATH', BASE_PATH.SYS_DIR.'/');
else 
	exit('A pasta do sistema não foi configurada corretamente: ' . $sis_folder);


/**
 *	Definição da Pasta da Aplicação
 *	@var string APP_PATH
 */
if(is_dir(BASE_PATH.APP_DIR))
	define('APP_PATH', BASE_PATH.APP_DIR.'/');
else
	exit('A pasta da aplicação não foi configurada corretamente: ' . $sis_folder);


/**
 * Definição do Caminho Raiz do Servidor
 * @var string HTTP_PATH
 */
define('HTTP_PATH', 	'http://'.$_SERVER['HTTP_HOST']);










/**
 * Chamada do Controler e Inicialização
 */
require_once SYS_PATH.'/control.php';
$o_control = new Control();
