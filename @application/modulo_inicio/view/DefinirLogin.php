<html> 
  <head> 
   <title><?php echo $this->o_config->getParam('st_system_title')?></title> 
   <meta content='text/html; charset=utf-8' http-equiv='Content-Type'> 
   <meta content='IE=EmulateIE7' http-equiv='X-UA-Compatible'> 
   <meta content='no-cache, no-store' http-equiv='Cache-Control'> 
   <meta content='no-cache, no-store' http-equiv='Pragma'> 
   <link href='template/<?php echo $this->o_config->getParam('st_default_template')?>/style.css' type='text/css' rel='stylesheet'>
  </head> 
  <body> 
   <div id='Tab1' align='center'> 
    <div id='LoginBlock'> 

    <?php
	$st_mensagem = $this->o_params->getParam('erro');
    if(!isset($st_mensagem))
     	$st_mensagem = 'Para confirmar seu primeiro acesso, repita sua senha duas vezes';	
    ?>
     <h4 class='RedAlert'><?php echo $st_mensagem?></h4>
     <form  method='POST' name='form1' action="index.php"> 
      <label>Usu&aacute;rio
       <input type='text' value="<?php echo $_REQUEST['usuario'] ?>" disabled="disabled"> 
       <input type='hidden' name='usuario' id='usuario' value="<?php echo $_REQUEST['usuario'] ?>">
      </label> 
      <label>Senha
       <input type='password' name='senha' id='senha'> 
      </label>
      <label>Confirma
       <input type='password' name='senha_2' id='senha'> 
      </label>  
      <input type="hidden" name="action" value="definirsenha">
      <button type='submit' class='bt_blue'>Gravar</button> 
     </form> 
    </div> 
   </div> 
  </body> 
 </html>