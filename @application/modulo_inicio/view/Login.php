<h4 class="hb" align="center"><strong>Acesso a Área do Professor</strong></h4>
<div id='LoginBlock' align="center">
	<div class="ppa mb">
		<p>
			<strong>Caros Professores(as)</strong>
		</p>
		<p align="center">A Área do Professor está sendo remodelada para
			aperfeiçoar e facilitar a sua utilização</p>
	</div>
	<?php $this->showExceptions();?>
	<form method='POST' name='form1' class="form_login">
		<div class="mb ppt">
			<label>Usu&aacute;rio <input type='text' name='st_username' id='st_username'>
			</label>
		</div>
		<div class="mb">
			<label>Senha <input type='password' name='st_password' id='st_password'> </label><input
				type="hidden" name="action" value="login">
		</div>
		<div align="center" class="ppt">
			<input type='hidden' name="action" value="login">
			<button type='submit' class='bt_blue bt_grande'>Entrar</button>
		</div>
	</form>
</div>