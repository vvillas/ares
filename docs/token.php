<?/* Recomendamos chamar este conteúdo em uma nova Aba */?>
<html>
<body onload="document.forms['acesso_ubc'].submit();">
<?php
	//CPF do Aluno - somente numeros
	$cpf = '12345678910';
	//CPF com menos de 11 casas completa com zeros a esqerda
	$cpf = str_pad($cpf,11,"0",STR_PAD_LEFT);	
	
	//numero do registro do aluno
	$registro = '1';
	
	//hora atual [yyyy-mm-dd hh:mm] ex: 2012-10-10 12:30
	$time = strtotime(date('Y-m-d H:i'));
	
	//montagem do token de autenticação 
	$token = md5($registro.$cpf.$time);		
?>
	<p align="center">Aguarde...</p>
	<form method="POST" name="acesso_ubc" action="http://www3.brazcubas.br/ADAEAD/">
		<input type="hidden" name="in_registro" value="<?=$registro?>">
		<input type="hidden" name="st_token" value="<?=$token;?>">
		<input type="hidden" name="action" value="login">
	</form>
</body>
</html>