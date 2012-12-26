<body onload="document.forms['acesso_ubc'].submit();">
<div align="center">
<p align="center">Aguarde...</p>
<div align="right">
	<?php
		//valor do cpf do aluno com tratamento de zeros a esquerda
		$cpf = str_pad('12345678910',11,"0",STR_PAD_LEFT);	
		
		//numero do registro do aluno
		$registro = '1';	
		
		//hora atual [yyyy-mm-dd hh:mm] ex: 2012-10-10 12:30
		$time = strtotime(date('Y-m-d H:i'));
		
		//montagem do token de autentica��o 
		$token = md5($registro.$cpf.$time);		
	?>
	<form method="POST" name="acesso_ubc" class="form_login mb pt" action="/ADAEAD/">
		<p>Registro: <input type="text" name="in_registro" value="<?=$registro?>"></p>
		<p>Token: <input type="hidden" name="st_token" value="<?=$token;?>"></p>
		<input type="hidden" name="action" value="login">
		<div align="center" class="ppt">
			<button type="submit" class="bt_blue bt_grande">Entrar</button>
		</div>
	</form>
</div>
</div>
</body>