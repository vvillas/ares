<div id="sis_ctr" class="sis_ctr">
	<div class="conteudoTotal clearfix">
		<div class="flr pr">
			<form method="POST" action="?inicio">
				<input type="hidden" name="action" value="logout">
				<button class="bt_gray" type="submit" >Sair</button>
			</form>
		</div>
		<div class="pl">
			<span>Bem vindo(a): </span><strong><?=$o_user->getNome();?></strong>
		</div>
	</div>
</div>