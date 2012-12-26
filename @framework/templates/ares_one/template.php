<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title><?=$this->getPageTitle();?></title>
<meta name="Author" content="Departamento de Tecnologia da Universidade Braz Cubas">
<meta name="description" content="UBC - Universidade BRAZ CUBAS - Mogi das Cruzes. Ensino Superior, Educação a Distância. Todos os direitos reservados. www.brazcubas.br">
<meta name="keywords" content="UBC, Universidade Braz Cubas, Mogi das Cruzes, Ensino Superior, Educação a Distância">
<link href="<?=TPL_PATH?>/css/style.css" rel="stylesheet" type="text/css">
<script src="<?=TPL_PATH?>/js/jquery.js"></script>
<?php
 
$this->echoJavaScripts(); /*<script src="<?=TPL_PATH?>/js/json2.js"></script>*/ 
?>
<link rel="shortcut icon" href="<?=TPL_PATH?>/images/favicon.ico">
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
</head>

<body class="widgets_on">
	<div id="header" class="wrapper">
		<div id="overBox" style="display: none;">
			<div class="modalWindow">
				<a href="#" onclick="clearErrorMsg();"
					class="btClose"> <img
					src="<?=TPL_PATH?>/images/btFechar.gif" alt="Fechar" /> </a>
				<div id="messageHolder" class="RedAlert">
				<?php $this->showExceptions();?>
				</div>
				<div align="center">
					<button id="bt_close_modal" class="bt_gray bt_wide" onclick="clearErrorMsg();">OK</button>
				</div>
			</div>
		</div>
	</div>
	<div id="conteudo" class="wrapper">
	
		<?php 
		$this->showWidget('sis_controls');
		
		$content_class = NULL;
		$content_class = 'lb_on';
		
		if(!strlen(($leftbar = $this->showLeftBar())))
			$content_class = 'lb_off';
		
		?>
		<div id="conteudoCorpo" class="conteudoTotal clearfix <?=$content_class?>">
		<?php
		if(strlen($leftbar)>0)
		{
			?>
			<div id="colEsq">
				<div id="colEsqRecip" class="pb">
					<?$this->showWidget('usr_menu');?>		
				</div>
			</div>
			<?php
		} 
		?>
			<div id="colCont">
				<div id="colContRecip" class="clearfix">
					<div>
						<div class="colConteudo ppt ppb pr"><?php $this->showWidget('usr_toolbar'); ?></div>
						
						<div><?php echo $this->getContents();?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer" class="wrapper">
		<div class="conteudoTotal">
			<div class="canvas">
			<p>&nbsp;</p>
			</div>
		</div>
		<!--fim div DVrodape-->
		<div class="FTcopy" align="center">© ARES Framework - Todos os direitos reservados.</div>
	</div>
</body>
</html>